#!/bin/bash

# GLOBAL VARIABLES
ROOT="/site"

# COMMAND LINE VARIABLES
COMMAND=$1

del_stopped(){
	local name=$1
	local state
	state=$(docker inspect --format "{{.State.Running}}" "$name" 2>/dev/null)

	if [[ "$state" == "false" ]]; then
		docker rm "$name"
	fi
}

run_test(){
	docker run --rm \
		-v "$(pwd)":$ROOT \
		alpine-phpunit:3.3 --bootstrap $ROOT/settings.php $ROOT/tests
}

run_server(){
	del_stopped tfatf
	docker run --rm \
		--name=tfatf \
		-e "WEBAPP_ROOT=public/" \
		-v "$(pwd)":/$ROOT \
		-p 80:80 \
		alpine-php:3.3
}

build_images(){
	docker build -t alpine-php:3.3 . && cd /tests && docker build -t alpine-phpunit:3.3 .
}

update_tfatf(){
	curl -sSL https://raw.githubusercontent.com/delete/thanksforallthefish/master/install.sh | sh
}

case "$COMMAND" in
	-t) run_test; ;;
	-r) run_server; ;;
	-b) build_images; ;;
	-c) del_stopped tfatf; ;;
	-u) update_tfatf tfatf; ;;

	*) echo $'Usage: \n\t' "$0" \
		$'-t  to run all tests \n\t' "$0" \
		$'-r  to run the local server \n\t' "$0" \
		$'-b  to build Docker images \n\t' "$0" \
		$'-u  to update tfatf framework \n\t' "$0" \
		$'-c  to clean containers' ;;
esac
