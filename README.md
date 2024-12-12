### Requirements

- PHP 8.1+

### App/Admin Credentials
Username: admin@admin.com  
Password: password  
Link: /admin

###Schedule running
Schedule is running once a day at 03:00 AM, details in app/Console/Commands/SyncCurrencyRates.php, routes/console.php

### Steps to start app

- create database `currency_rates`
- php artisan migrate
- php artisan db:seed




