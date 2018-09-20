setup:
	composer install
	touch database/database.sqlite
	php database/cmd -a migrate
	php -S localhost:8000 -t public
