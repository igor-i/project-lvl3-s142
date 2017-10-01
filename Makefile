lint:
	composer run-script phpcs -- --standard=PSR2 public routes tests
test:
	DB_CONNECTION="sqlite"
	DB_DATABASE=":memory:"
	DB_PREFIX=""
	CACHE_DRIVER="file"
	QUEUE_DRIVER="sync"
	php artisan migrate
	phpunit
install:
	composer install
run:
	php -S localhost:8000 -t public
logs: 
	tail -f storage/logs/lumen.log
