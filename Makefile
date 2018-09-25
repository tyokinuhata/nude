setup:
	composer install
	touch database/database.sqlite
	php nude migration:migrate
	php -S localhost:8000 -t public
