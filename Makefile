.PHONY: $(MAKECMDGOALS)

.DEFAULT_GOAL := help
SHELL := /bin/bash

up: #Запуск наших контейнеров
	docker-compose up -d

up-alone: #Запуск наших контейнеров, остановка других контейнеров, которые остались открытыми
	docker-compose up -d --remove-orphans

down: #Остановка контейнера
	docker-compose down

down-all: #Остановка наших контейнеров + всех остальных, которые остались открытыми
	docker-compose down --remove-orphans

composer-install: #Запуск установки пакетов композером
	docker-compose exec php composer install

test: #Запуск теста
	docker-compose exec php ./vendor/bin/phpunit tests/Unit

fixtures: #Заполнение базы данных таблицами из сущностей + загрузка фикстур
	docker-compose exec php php bin/console doctrine:schema:update --dump-sql && docker-compose exec php php bin/console doctrine:schema:update --force && docker-compose exec php php bin/console doctrine:fixtures:load -n