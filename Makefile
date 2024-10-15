dev:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer install --no-scripts --ignore-platform-reqs -o
	docker compose up -d && docker compose exec app php artisan migrate && docker compose exec app php artisan key:generate
stop:
	docker compose down
refresh: stop dev
secret:
	docker compose exec app php artisan jwt:secret
migrate:
	docker compose exec app php artisan migrate
cache:
	docker compose exec app php artisan optimize:clear
update:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer update --no-scripts --ignore-platform-reqs -o
require:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer require $(package)
