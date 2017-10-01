lint:
	composer run-script phpcs -- --standard=PSR2 public routes tests
test:
	env
	php artisan migrate
	phpunit
install:
	composer install
run:
	php -S localhost:8000 -t public
logs: 
	tail -f storage/logs/lumen.log
