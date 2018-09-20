setup:
	composer install
	touch database/database.sqlite
	php database/command -a migrate
	php -S localhost:8000 -t public
