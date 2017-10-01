lint:
	composer run-script phpcs -- --standard=PSR2 public routes tests
test:
	env APP_ENV="local"
	env DB_CONNECTION="sqlite"
	env DB_DATABASE=":memory:"
	env DB_PREFIX=""
	env CACHE_DRIVER="file"
	env QUEUE_DRIVER="sync"
	php artisan migrate
	phpunit
install:
	composer install
run:
	php -S localhost:8000 -t public
logs: 
	tail -f storage/logs/lumen.log
