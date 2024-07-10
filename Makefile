SHELL := /bin/bash

build:
	docker-compose build
up:
	CURRENT_USER=$$(id -u):$$(id -g) docker-compose up -d
down:
	docker-compose down --remove-orphans
down-v:
	docker-compose down -v --remove-orphans
tests: export APP_ENV = test
tests:
	php bin/phpunit
.PHONY:tests