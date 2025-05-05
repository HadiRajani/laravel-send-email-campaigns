Laravel Send Email Campaigns

This is a Laravel package to send email campaigns to customers by filtering them based on certain criteria. The package follows an API-first approach and supports queued email sending.

---

Installation Steps:

1. Create a Laravel Project (if not already):
   laravel new your-project-name
   cd your-project-name

2. Add the following to your composer.json:

"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/HadiRajani/laravel-send-email-campaigns.git"
  }
],
"require": {
  "ali-hadi/email-campaign": "dev-main"
}

Then run:
composer update

---

3. Import customers table:
Use the provided customers.sql file and import it into your Laravel project's database using phpMyAdmin or MySQL CLI.

---

4. Publish the migrations:
php artisan vendor:publish --tag=email-campaign-migrations

Then run:
php artisan migrate

---

5. Set up mail configuration in your .env file:

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Campaign Sender"

---

6. Set queue driver to database in .env:

QUEUE_CONNECTION=database

Then run:
php artisan queue:table
php artisan migrate
php artisan queue:work

---

Usage:

Use the provided Postman collection to test the following APIs:
- Create Campaign
- Filter Audience
- Send Campaign
- Track Email Status

Make sure to replace `{{path}}` variable in Postman with your local or deployed project URL.

---

That's all. Now your Laravel project is ready to use the Email Campaign package.

