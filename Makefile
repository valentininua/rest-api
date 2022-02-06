SHELL := /bin/bash

dev: export APP_ENV=test
dev:
	php -S 127.0.0.1:8888 -t public
#	symfony console doctrine:database:create
#	symfony console doctrine:schema:create
# 	symfony console doctrine:database:drop --force || true
# 	symfony console doctrine:database:create
# 	symfony console doctrine:migrations:migrate -n
# 	symfony console doctrine:fixtures:load -n
#	symfony php bin/phpunit $@
.PHONY: dev