#Variables
DOCKER_COMPOSE=docker-compose -f docker-compose.yml -p local

PROJECT_NAME=symfony-6.3

export CURRENT_USER=$(shell id -u):$(shell id -g)

#Commands
build:
	$(DOCKER_COMPOSE) build

up:
	$(DOCKER_COMPOSE) up -d

up_rebuild:
	$(DOCKER_COMPOSE) up -d --build

down:
	$(DOCKER_COMPOSE) down -v

ssh:
	$(DOCKER_COMPOSE) exec php bash

clear_cache:
	$(DOCKER_COMPOSE) exec php bin/console cache:clear

migrate:
	$(DOCKER_COMPOSE) exec php bin/console doctrine:migrations:migrate

load_fixtures:
	$(DOCKER_COMPOSE) exec php bin/console doctrine:migrations:migrate

composer_install:
	$(DOCKER_COMPOSE) $(EXECUTION_TYPE) php composer install --verbose --prefer-dist --optimize-autoloader --no-progress --no-scripts