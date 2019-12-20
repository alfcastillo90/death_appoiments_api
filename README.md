# Dancing with Death
REST API for scheduling appointments to have a dance with Death.
## Getting started
- git clone https://github.com/alfcastillo90/death_appoiments_api.git
- cd death_appoiments_api
- create .env file
- composer install
- php artisan migrate:fresh --seed
- php artisan passport:install
- "./vendor/bin/phpunit"
