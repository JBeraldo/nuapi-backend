dev:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer install --no-scripts --ignore-platform-reqs -o
	docker compose up -d && docker compose exec app php artisan migrate
stop:
	docker compose down
refresh: stop dev
key:
	docker compose exec app php artisan key:generate
migrate:
	docker compose exec app php artisan migrate
cache:
	docker compose exec app php artisan optimize:clear
update:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer update --ignore-platform-reqs --no-scripts
