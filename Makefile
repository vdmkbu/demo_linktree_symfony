docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

init: docker-build composer migrate fixtures

migration:
	docker-compose exec php-cli bin/console make:migration

migrate:
	docker-compose exec php-cli bin/console doctrine:migrations:migrate -n

fixtures:
	docker-compose exec php-cli bin/console doctrine:fixtures:load -n

composer:
	docker-compose exec php-cli composer install

get-random-user:
	docker-compose exec php-cli bin/console app:random-user