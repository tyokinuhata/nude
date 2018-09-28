setup:
	composer install
	touch database/database.sqlite
	php nude migration:migrate
	php nude server
