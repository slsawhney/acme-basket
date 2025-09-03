IMAGE_NAME=acme-basket

.PHONY: build run test shell phpcs phpcbf phpstan

build:
	docker-compose build
	docker-compose run --rm $(IMAGE_NAME) composer install --no-interaction --prefer-dist

run:
	docker-compose run --rm $(IMAGE_NAME) php run.php

test:
	docker-compose run --rm $(IMAGE_NAME) ./vendor/bin/phpunit tests

shell:
	docker-compose run --rm $(IMAGE_NAME) bash

# Check code style (PSR-12)
phpcs:
	docker-compose run --rm $(IMAGE_NAME) ./vendor/bin/phpcs --standard=PSR12 src tests

# Automatically fix code style issues
phpcbf:
	docker-compose run --rm $(IMAGE_NAME) ./vendor/bin/phpcbf --standard=PSR12 src tests

# Static analysis for types and errors
phpstan:
	docker-compose run --rm $(IMAGE_NAME) ./vendor/bin/phpstan analyse src tests --level=max
