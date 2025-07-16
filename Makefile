.PHONY: up down build start stop restart shell logs composer install update require dump-autoload test artisan migrate fresh seed tinker npm yarn dev watch

default: up

up:
	@echo "Starting containers..."
	docker-compose up -d

down:
	@echo "Stopping containers..."
	docker-compose down

build:
	@echo "Building containers..."
	docker-compose build

start:
	@echo "Starting containers..."
	docker-compose start

stop:
	@echo "Stopping containers..."
	docker-compose stop

restart:
	@echo "Restarting containers..."
	docker-compose restart

shell:
	@echo "Entering app container..."
	docker-compose exec app bash

logs:
	@echo "Showing logs..."
	docker-compose logs -f

composer:
	@echo "Running composer..."
	docker-compose exec app composer $(filter-out $@,$(MAKECMDGOALS))

install:
	@echo "Installing dependencies..."
	docker-compose exec app composer install

update:
	@echo "Updating dependencies..."
	docker-compose exec app composer update

require:
	@echo "Requiring package..."
	docker-compose exec app composer require $(filter-out $@,$(MAKECMDGOALS))

dump-autoload:
	@echo "Dumping autoload..."
	docker-compose exec app composer dump-autoload

test:
	@echo "Running tests..."
	docker-compose exec app php artisan test

artisan:
	@echo "Running artisan..."
	docker-compose exec app php artisan $(filter-out $@,$(MAKECMDGOALS))

migrate:
	@echo "Running migrations..."
	docker-compose exec app php artisan migrate

fresh:
	@echo "Fresh migrations..."
	docker-compose exec app php artisan migrate:fresh

seed:
	@echo "Running seeds..."
	docker-compose exec app php artisan db:seed

tinker:
	@echo "Running tinker..."
	docker-compose exec app php artisan tinker

npm:
	@echo "Running npm..."
	docker-compose exec npm npm $(filter-out $@,$(MAKECMDGOALS))

yarn:
	@echo "Running yarn..."
	docker-compose exec npm yarn $(filter-out $@,$(MAKECMDGOALS))

dev:
	@echo "Running dev..."
	docker-compose exec npm npm run dev

watch:
	@echo "Running watch..."
	docker-compose exec npm npm run watch

%:
	@: