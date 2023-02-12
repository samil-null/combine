start-dev-app:
	cp ./docker/envs/.env.dev .env
	docker-compose -f ./docker/docker-compose-dev.yml --env-file=.env up -d --build --remove-orphans
