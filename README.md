### Introduction

This is a project to demostrate the real time event in an auction platform using Laravel Reverb.

### Requirements

- PHP 8.3
- MySQL

### Steps

- Clone the repository
- Run the command `composer install`
- Run the command `cp .env.example .env`
- Run the command `php artisan key:generate`
- Adjust your APP_URL in your .env file
- Run the command `php artisan reverb:install`
- Run the command `php artisan migrate --seed`
- Run the command `npm install` and in another terminal run `php artisan reverb:start --debug`

### Usage

The system has two types of users: Admin and User.

These are the users registered by the seeders:

**Admin**

email: admin@curotec.com

password: password

**Users**

email: user01@curotec.com

password: password

email: user012@curotec.com

password: password


