up:
	@docker-compose up

down:
	@docker-compose down

migrate:
	docker exec -it nullpointer_php_1 bash -c "php /var/www/html/app/bin/console make:migration"
	docker exec -it nullpointer_php_1 bash -c "php /var/www/html/app/bin/console doctrine:migration:migrate -n"
