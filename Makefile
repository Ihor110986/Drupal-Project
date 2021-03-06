.PHONY: up down stop start install cli test
include .env

default: install

up:
	docker-compose up -d
down:
	docker-compose down
stop:
	docker-compose stop
start:
	docker-compose start
install: up
	@while [ -z "$$(docker-compose exec -T $(MYSQL_HOST) mysql -u$(MYSQL_USER) -p$(MYSQL_PASS) -N -B -e "SHOW DATABASES;" | grep $(MYSQL_DB_NAME))" ]; do echo "Waiting for database..."; sleep 1; done
	docker-compose exec -T php composer install --no-interaction
	docker-compose exec -T php bash -c "drush site:install --existing-config --db-url=mysql://$(MYSQL_USER):$(MYSQL_PASS)@$(MYSQL_HOST):$(MYSQL_PORT)/$(MYSQL_DB_NAME) -y"
	docker-compose exec -T php bash -c 'mkdir -p "drush" && echo -e "options:\n  uri: http://$(PROJECT_BASE_URL)" > drush/drush.yml'
cli:
	docker-compose exec php bash
node-cli:
	docker-compose exec node bash
test:
# 	docker-compose exec -T php bash -c 'composer phpcs'
	docker-compose exec -T php curl 0.0.0.0:80 -H "Host: $(PROJECT_BASE_URL)"