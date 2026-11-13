#!/bin/bash
#
# Deploy the Nuxt build to the server: rsync the build into the base path + pm2 restart.
#
#   yarn deploy                # build + upload + restart
#   bash deploy.sh --skip-build   # reuse the existing .output
#
# Server layout ($SSH_BASE_PATH):
#   server/, public/, nitro.json   the build (replaced on every deploy; nothing else in the base path is touched)
#   data/bhakta.sqlite3        the database (NEVER touched by a deploy)
#   data/photos/               uploaded photos (never touched either)
#   ecosystem.config.js        pm2 config with the env (copied from ./ecosystem.config.js if missing)
#
# First deploy: see README "Deploy" (the database has to be uploaded once).

# ---- adjust these to the real server --------------------------------------------------------
SSH_USER_ALIAS='bhakta_balarama'                       # Host entry in ~/.ssh/config
SSH_BASE_PATH='/var/www/bhakta.1108.cc/web'
PM2_APP_NAME='bhakta.1108.cc'
APP_PORT=3005                                          # must match ecosystem.config.js
SITE_URL='https://bhakta.1108.cc'
# ---------------------------------------------------------------------------------------------

SSH_DB_PATH="$SSH_BASE_PATH/data/bhakta.sqlite3"

RED='\e[1;41m'
GREEN='\e[1;42m'
NC='\033[0m' # No Color

SKIP_BUILD=false
if [[ "$1" == "--skip-build" ]]; then
	SKIP_BUILD=true
fi

fail() { echo -e $'\n' "${RED} ⨯ $1 ${NC}" $'\n'; PREV_STEP=0; }
ok() { echo -e $'\n' "${GREEN} ✔ $1 ${NC}" $'\n'; }

PREV_STEP=1

if [ -n "$(git status --porcelain --untracked-files=no 2>/dev/null)" ]; then
	echo -e $'\n' "Warning: there are uncommitted changes, they will be deployed too." $'\n'
fi

# the local ecosystem.config.js (gitignored, holds the env) is needed on the first deploy
if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Checking server" $'\n'
	if ! ssh -o BatchMode=yes -o ConnectTimeout=10 $SSH_USER_ALIAS "true"; then
		fail "Cannot connect with ssh alias '$SSH_USER_ALIAS' (check ~/.ssh/config and SSH_USER_ALIAS in deploy.sh)"
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Checking Node.js version" $'\n'
	LOCAL_NODE=$(node -v)
	LOCAL_MAJOR=$(echo "$LOCAL_NODE" | sed 's/^v//' | cut -d. -f1)

	# pm2 show prints a table like: │ node.js version   │ 24.18.0 │
	SERVER_NODE=$(ssh $SSH_USER_ALIAS "pm2 show $PM2_APP_NAME 2>/dev/null" | grep -i 'node.js version' | grep -oE '[0-9]+\.[0-9]+\.[0-9]+' | head -n1)
	if [ -z "$SERVER_NODE" ]; then
		SERVER_NODE=$(ssh $SSH_USER_ALIAS "node -v")
	fi
	SERVER_MAJOR=$(echo "$SERVER_NODE" | sed 's/^v//' | cut -d. -f1)

	if [ -z "$SERVER_MAJOR" ]; then
		fail "Could not detect the server Node.js version"
	elif [ "$LOCAL_MAJOR" != "$SERVER_MAJOR" ]; then
		fail "Node.js major mismatch: local $LOCAL_NODE vs server $SERVER_NODE"
		echo "  better-sqlite3 and bcrypt are native modules: the build and runtime Node majors must match." $'\n'
	else
		ok "Node.js local $LOCAL_NODE / server $SERVER_NODE"
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Checking the server data" $'\n'
	# A deploy must never start the app on an empty database (it would be created without users).
	if ! ssh $SSH_USER_ALIAS "test -f $SSH_DB_PATH"; then
		fail "No database on the server ($SSH_DB_PATH)"
		echo "  Upload it once (this also creates the data dir):" $'\n'
		echo "    ssh $SSH_USER_ALIAS 'mkdir -p $SSH_BASE_PATH/data'" $'\n'
		echo "    rsync -avh --progress data/bhakta.sqlite3 $SSH_USER_ALIAS:$SSH_BASE_PATH/data/" $'\n'
	else
		ok "Database found on the server"
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	if [ "$SKIP_BUILD" = false ]; then
		echo $'\n' "Bump version number" $'\n'
		OLD_VERSION=$(node -p "require('./package.json').version")
		npm version patch --no-git-tag-version

		echo $'\n' "Rebuilding native modules" $'\n'
		npm rebuild better-sqlite3 bcrypt

		echo $'\n' "Running Build" $'\n'
		yarn build
		if [ $? -eq 0 ]; then
			ok "Build successful"
		else
			fail "Build failed"
			npm version --no-git-tag-version --allow-same-version "$OLD_VERSION"
			echo "Version number reverted" $'\n'
		fi
	else
		echo $'\n' "Skipping build (using the existing .output)" $'\n'
		if [ ! -f .output/server/index.mjs ]; then
			fail "There is no .output to deploy, run without --skip-build"
		fi
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Preparing the server" $'\n'
	ssh $SSH_USER_ALIAS "mkdir -p $SSH_BASE_PATH/data/photos"
	if [ $? -ne 0 ]; then
		fail "Failed to create the directories"
	fi
	# leftovers of the old release layout: a docRoot symlink (even a dangling one) is removed, a real folder is only reported
	ssh $SSH_USER_ALIAS "cd $SSH_BASE_PATH && if [ -L docRoot ]; then rm docRoot && echo 'removed the old docRoot symlink'; elif [ -d docRoot ]; then echo 'Note: the old docRoot folder is not used any more, you can delete it'; fi"
fi

if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Copy the build to $SSH_BASE_PATH" $'\n'
	# only the build's own paths are synced (and cleaned with --delete): data/, ecosystem.config.js and anything else stay untouched
	rsync --progress -azh --delete \
		--exclude='*.map' \
		--include='/server/***' --include='/public/***' --include='/nitro.json' \
		--exclude='*' \
		./.output/ $SSH_USER_ALIAS:$SSH_BASE_PATH/
	if [ $? -eq 0 ]; then
		ok "Build uploaded"
	else
		fail "Build upload failed"
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	if ! ssh $SSH_USER_ALIAS "test -f $SSH_BASE_PATH/ecosystem.config.js"; then
		echo $'\n' "No ecosystem.config.js on the server, uploading the local one" $'\n'
		if [ ! -f ecosystem.config.js ]; then
			fail "There is no local ecosystem.config.js (copy ecosystem.config.example.js and fill it in)"
		else
			rsync --progress -azh ./ecosystem.config.js $SSH_USER_ALIAS:$SSH_BASE_PATH/ || fail "ecosystem.config.js upload failed"
		fi
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	# the first deploys used ./docRoot/server/index.mjs; point an existing server config to ./server/index.mjs
	ssh $SSH_USER_ALIAS "cd $SSH_BASE_PATH && grep -q 'docRoot/server/index.mjs' ecosystem.config.js && sed -i 's#\./docRoot/server/index.mjs#./server/index.mjs#' ecosystem.config.js && echo 'ecosystem.config.js: script path updated'"
fi

if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Restarting PM2 process $PM2_APP_NAME" $'\n'
	# delete may fail on the very first deploy (nothing to delete), start is what matters
	ssh $SSH_USER_ALIAS "cd $SSH_BASE_PATH && (pm2 delete $PM2_APP_NAME 2>/dev/null; pm2 start ecosystem.config.js && pm2 save)"
	if [ $? -eq 0 ]; then
		ok "PM2 process restarted"
	else
		fail "PM2 restart failed"
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	echo $'\n' "Health check" $'\n'
	sleep 4
	STATUS=$(ssh $SSH_USER_ALIAS "curl -s -o /dev/null -m 15 -w '%{http_code}' http://localhost:$APP_PORT/login")
	if [ "$STATUS" == "200" ]; then
		ok "The app answers on port $APP_PORT"
	else
		fail "The app does not answer 200 on port $APP_PORT (got '$STATUS'). Check: ssh $SSH_USER_ALIAS 'pm2 logs $PM2_APP_NAME --lines 50'"
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	if [ -f .env.local ]; then
		source .env.local
	fi
	if [ -n "$CF_ZONE_ID" ] && [ -n "$CF_TOKEN" ]; then
		echo $'\n' "Purge Cloudflare cache" $'\n'
		curl_result=$(curl --request POST \
			--url https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/purge_cache \
			--header 'Content-Type: application/json' \
			--header "Authorization: Bearer $CF_TOKEN" \
			--data "{\"files\": [\"$SITE_URL/*\"]}" \
			-s)
		if [[ $(jq -r '.success' <<< "$curl_result") == "true" ]]; then
			ok "Cloudflare cache purged"
		else
			fail "Cloudflare cache purge failed"
			echo "Error purging cache: $(jq -r '.errors[0].message' <<< "$curl_result")"
		fi
	else
		echo $'\n' "CF_ZONE_ID / CF_TOKEN not set in .env.local, skipping the Cloudflare purge" $'\n'
	fi
fi

if [ $PREV_STEP -eq 1 ]; then
	ok "All is fine: $SITE_URL (v$(node -p "require('./package.json').version"))"
else
	exit 1
fi
