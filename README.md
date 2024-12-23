## iban-validator

This is simple and  application which can validate IBAN (International Bank Account Number), created for a code assesment as part of a recruting process of a reputed company in Sri Lanka. 

### Requirement Specification
- PHP 8.1 or highr
- npm 10.2 or highr
- Laravel 10 compatible database system (developed with mysql)

### How to setup/run the application

Please follow the steps mentioned below to setup and run the application after complete code correctly placed in your server. 

1. Open a terminal/cmd navigate to application root
2. Run `cp .env.example .env`
3. Update database informatio in `.env` file
4. Run `composer install` to download all the required php packages 
5. Run `php artisan key:generate` to generate Laravel app key
6. Run `php artisan migrate --seed` to migrate/create the database and seed admin account
7. Run `npm install` to download all the required node modules
8. Run `npm run build` to creates a build directory with a production build of your app
9. Run `php artisan serve` to start the applicationon `http://127.0.0.1:8000`
10. Use email: `admin@iban-validator.com` and password: `password` log into the application as pre-created admin user
11. Or create general user account following `Register` link
