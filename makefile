DC = docker-compose
DC_PHP = $(DC) exec php

up:
	$(DC) up -d --build

down:
	$(DC) down

php:
	$(DC_PHP) bash

composer-install:
	$(DC_PHP) composer install

db-migrate:
	$(DC_PHP) php bin/console doctrine:database:create --if-not-exists
	$(DC_PHP) php bin/console doctrine:migrations:migrate --no-interaction

generate-certs:
	mkdir -p ./docker/certs
	openssl req -x509 -newkey rsa:4096 -keyout ./docker/certs/privkey.pem -out ./docker/certs/fullchain.pem -days 365 -nodes -subj "/CN=localhost"

db-demo-data:
	$(DC_PHP) php bin/console app:loan-product-demo-data-load

process-async-events:
	$(DC_PHP) php bin/console messenger:consume async

install: composer-install db-migrate db-demo-data

start: up install