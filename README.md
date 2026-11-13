# Bhaktanyilvántartás

Nuxt 4 + Nuxt UI + nuxt-users + SQLite (rewrite of the old CakePHP 3 app, which is in git history before the `nuxt-rewrite` branch).

## Dev

```bash
yarn install
yarn dev          # http://localhost:3000, uses .env.local
```

`.env.local`: `NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH=./data/bhakta.sqlite3`

Everything private lives in `data/` (gitignored): the SQLite DB, uploaded photos (`data/photos`) and the legacy SQL dump (`data/import`).

## Roles

- `admin`: everything (edit bhaktas, services, departments, lookup tables, users)
- `user`: read-only; sees only centers assigned in the `centers_users` table (`center_id`, `user_id` = nuxt-users `users.id`)
- `api`: token-only account for other apps (Laksmi); may only call the bhakta name list of its assigned centers (see below)

Nothing is public except what nuxt-users leaves open (login, logout, password reset). Beware: nuxt-users only enforces the
login for paths under `/api/`; a server route outside `/api` or with a dot in the path (`*.json`) would be public.

Create a user:

```bash
set -a; source .env.local; set +a
DB_PATH=$NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH yarn nuxt-users create-user --email=… --name=… --password=… --role=admin
```

## Bhakta name list for Laksmi

`GET /api/departments/bhakta-list` (today) and `GET /api/departments/bhakta-list/2026-01-31` (on a date) return
`{"departments":[{"department":"…","center":"…","bhaktas":["name", …]}]}` for the centers assigned to the token's user
(`centers_users`; none assigned = empty list). The token goes in the `auth_token` cookie
(nuxt-users has no bearer support):

```bash
curl -H "Cookie: auth_token=<token>" https://<host>/api/departments/bhakta-list
```

API accounts and tokens are managed by hand (no UI). Add one:

```bash
set -a; source .env.local; set +a
DB_PATH=$NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH yarn nuxt-users create-user \
  --email=laksmi@api.local --name="Laksmi" --password="$(openssl rand -hex 16)Aa1#" --role=api   # password is never used

TOKEN=$(openssl rand -hex 32); echo "$TOKEN"
sqlite3 data/bhakta.sqlite3 "INSERT INTO personal_access_tokens (tokenable_type, tokenable_id, name, token, expires_at, created_at, updated_at)
  SELECT 'user', id, 'api_token', '$TOKEN', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM users WHERE email = 'laksmi@api.local'"
```

Assign the center(s) it may see (users page > edit > Központok, or by hand):

```bash
sqlite3 data/bhakta.sqlite3 "INSERT INTO centers_users (center_id, user_id) SELECT 1, id FROM users WHERE email = 'laksmi@api.local'"
```

Revoke (or rotate: revoke, then insert a new one):

```bash
sqlite3 data/bhakta.sqlite3 "DELETE FROM personal_access_tokens WHERE name = 'api_token' AND tokenable_id = (SELECT id FROM users WHERE email = 'laksmi@api.local')"
```

Deactivating the user on the users page, or changing its role, also revokes its tokens. Tokens are stored as plain text (nuxt-users design).

## Deploy

```bash
yarn deploy                   # build, upload into the server base path, restart pm2, health check
bash deploy.sh --skip-build   # reuse the existing .output
```

Settings (ssh alias, server path, pm2 name, port) are at the top of `deploy.sh`. The build goes straight into the server base path (`server/`, `public/`, `nitro.json`, replaced on every deploy) and
`data/` (sqlite + photos) lives next to it, so a deploy never touches the data or anything else in that folder.
The script stops before switching if the Node major differs from the server (native modules) or if the server has no
database yet. A Cloudflare purge runs only when `CF_ZONE_ID` and `CF_TOKEN` are in `.env.local`.

First deploy:

```bash
cp ecosystem.config.example.js ecosystem.config.js     # fill in the mailer, check the paths and the port
ssh <alias> 'mkdir -p /var/www/bhakta.1108.cc/web/data'
rsync -avh --progress data/bhakta.sqlite3 <alias>:/var/www/bhakta.1108.cc/web/data/
rsync -avh --progress data/photos/ <alias>:/var/www/bhakta.1108.cc/web/data/photos/   # if you have photos
yarn deploy
```

The nginx/Apache site must proxy to the pm2 port. Do not upload `data/import` (the legacy SQL dump).

## Migrating the legacy MariaDB data

```bash
yarn nuxt-users migrate            # nuxt-users tables (with DB_PATH set as above)
node scripts/migrate-legacy.mjs data/import/c10_bhakta.sql data/bhakta.sqlite3
```

Re-runnable: it replaces the content of the data tables (not users). Legacy users, sessions and `centers_users` are not migrated. Photos: copy the old `webroot/img/bhaktas/*` files into `data/photos/`.
