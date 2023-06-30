#!/bin/bash

# SSH should be set up to do not ask for password
# https://www.thegeekstuff.com/2008/11/3-steps-to-perform-ssh-login-without-password-using-ssh-keygen-ssh-copy-id/

RED='\e[1;41m'
GREEN='\e[1;42m'
NC='\033[0m' # No Color

SSH_USER=$1
SSH_HOST=$2
SSH_PATH='../../web/'

if ! echo "$SSH_USER" | grep -q "bhak"; then
	echo -e "${RED}The SSH_USER seems to be different then the required${NC}"
    exit 1
fi

PREV_STEP=1
# commented out as they need fix to run in docker
# echo $'\n' "Running Backend Tests" $'\n'
# vendor/bin/phpunit
# if [ $? -eq 0 ]; then
# 	echo -e $'\n' "${GREEN} \u2714 All backend tests passed ${NC}" $'\n'
# 	PREV_STEP=1
# else
# 	echo -e $'\n' "${RED} \u2a2f Some backend tests failed ${NC}" $'\n'
# 	PREV_STEP=0
# fi

if [ $PREV_STEP -eq 1 ];then
	echo $'\n' "Copy all folders to server without vendor and ignored files" $'\n'
	rsync --progress -azh \
		--exclude='.git/' \
		--exclude='config/app_local.php' \
		--exclude='config/.env' \
		--exclude='logs/' \
		--exclude='tmp/' \
		--exclude='vendor/' \
		./ \
		-e "ssh -i /home/rrd/.ssh/id_ed25519" \
		$SSH_USER@$SSH_HOST:$SSH_PATH"/"

	if [ $? -eq 0 ]; then
		echo -e $'\n' "${GREEN} \u2714 all folders uploaded ${NC}" $'\n'
	else
		echo -e $'\n' "${RED} \u2a2f all folders upload failed ${NC}" $'\n'
		PREV_STEP=0
	fi
fi

if [ $PREV_STEP -eq 1 ];then
	echo $'\n' "Run composer install on server" $'\n'
	ssh -i /home/rrd/.ssh/id_ed25519 -t $SSH_USER@$SSH_HOST "chmod 775 -R ${SSH_PATH}/"
	ssh -i /home/rrd/.ssh/id_ed25519 -t $SSH_USER@$SSH_HOST "cd ${SSH_PATH}/ && /usr/bin/php7.3 /usr/local/bin/composer install --no-dev --no-interaction --optimize-autoloader"

	echo $'\n' "Set permissions" $'\n'
	ssh -i /home/rrd/.ssh/id_ed25519 -t $SSH_USER@$SSH_HOST "find ${SSH_PATH}/ -type f -exec chmod 644 {} \;"
	ssh -i /home/rrd/.ssh/id_ed25519 -t $SSH_USER@$SSH_HOST "find ${SSH_PATH}/ -type d -exec chmod 755 {} \;"
	ssh -i /home/rrd/.ssh/id_ed25519 -t $SSH_USER@$SSH_HOST "chmod +x ${SSH_PATH}/bin/cake"

	if [ $? -eq 0 ]; then
		echo -e $'\n' "${GREEN} \u2714 composer install was successfull ${NC}" $'\n'
	else
		echo -e $'\n' "${RED} \u2a2f composer install failed ${NC}" $'\n'
		PREV_STEP=0
	fi
fi

if [ $PREV_STEP -eq 1 ];then
	echo -e $'\n' "Clear all cache" $'\n'
	ssh -i /home/rrd/.ssh/id_ed25519 -t $SSH_USER@$SSH_HOST "export PHP=/usr/bin/php7.3 && cd ${SSH_PATH}/ && bin/cake cache clear_all"
	if [ $? -eq 0 ]; then
		echo -e $'\n' "${GREEN} \u2714 Cache cleared ${NC}" $'\n'
	else
		echo -e $'\n' "${RED} \u2a2f Cache clear failed ${NC}" $'\n'
		PREV_STEP=0
	fi
fi

if [ $PREV_STEP -eq 1 ];then
	echo -e $'\n' "${GREEN} \u2714 All is fine ${NC}" $'\n'
fi