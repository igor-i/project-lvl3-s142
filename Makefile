lint:
	composer run-script phpcs -- --standard=PSR2 public routes tests
test:
	phpunit
install:
	composer install
run:
	php -S localhost:8000 -t public
logs: 
	tail -f storage/logs/lumen.log
deploy:
	git push heroku master
	heroku run php artisan queue:restart
jobs:
	php artisan queue:work --once