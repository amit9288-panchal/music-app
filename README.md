
## Music APP

## Requirement

- php ^8.0

## Installation

Clone the repository 

- git clone https://github.com/amit9288-panchal/music-app.git

Enter to repository

- cd sphera

Install laravel dependencies using composer

- composer install

Copy example env file and change configuration as per required and set API_TOKEN 

- cp .env.example .env

Run database migration

- php artisan migrate

Run DB Seeder

- php artisan db:seed

Start local server on required port

- php artisan serve --port=8282

Now you can access the server using http://localhost:8282

Please note while calling api you need to pass auth-key and auth-token as per authentication
