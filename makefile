start-dev-app:
	docker-compose -f ./docker/docker-compose-dev.yml --env-file=./docker/envs/.env.dev up -d --remove-orphans
