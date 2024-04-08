install:
	docker-compose up --build --remove-orphans --force-recreate --detach
	docker-compose exec -T php composer install
	docker-compose exec -T php bin/console doctrine:database:create --if-not-exists
	docker-compose exec -T php bin/console doctrine:schema:update --force
	docker-compose exec -T php bin/console doctrine:fixtures:load --append
	docker-compose exec -T php bin/console sass:build
	docker-compose exec -T php bin/console c:c