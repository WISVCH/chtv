# CH TV

## Setting up for development

1. Clone the repository
2. Set up your database and put the settings in `.env`. You can copy `.env.example` to `.env` as a starter.
3. Install the composer dependencies\
`composer install`
4. Install the NPM dependencies\
`npm install`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `php artisan db:seed` to run seeders, if any.
8. Run `php artisan serve`

You can now access the laravel project at https://localhost:8000

## Running using a docker container
1. Build the docker container\
`docker build -t wisvch/chtv .`
2. Run the docker container\
`docker run -p 8000:80 wisvch/chtv`