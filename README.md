# PHP Test Project

Available on https://us.forst.dev/

### Description

This is a very simple one-page application consisting of a single table and a form for creating new rows.
To make it a little more complicated, we have written a 'framework' you have to use.
Below is a set of simple tasks to perform. Please write a production-ready code.

### Installation

1. Create a private GitHub repository and invite @jurajmasar and @gyfis as collaborators
2. Create a new MySQL database
3. Rename `config/database` to `config/database.php` and configure your database connection settings in this file
4. Import `database/schema.sql` into your database

### Tasks to perform

1. Style the page using [Bootstrap](http://getbootstrap.com/) or [Tailwind](http://tailwind.com/)

* Every other table row should be highlighted.
* Use Bootstrap’s form-horizontal or equivalent to style the form.
* Please make any other styling changes based on your preferences to make the interface look presentable.

2. Add a validation of new records.
3. Create a JS functionality to filter rows by city.
4. Implement submission of the form using AJAX.
5. Add a phone number column to the table.
6. Please deploy the project to any freehosting and send us the production link.

Thank you! 🙏

# Solution

I added one dependency to this project - [libphonenumber](https://github.com/giggsey/libphonenumber-for-php) as
validating phone numbers is quite hard to do by hand and Google has a very nice library for that.

In order to install it, run `composer install`.

Other than that I didn't add anything else.

I have close to zero experience with PHP so it is very likely that my code here does not follow best practices for PHP,
sorry for that, I'd need code review before pushing this code somewhere.

## Project Setup

Feel free to use local `docker-compose.yml` to spin off the database - `docker compose up -d db` will start local
MySQL with data mounted in.

## Deployment

In order to run it inside docker, create `.env` file and fill real values from `.env.template`.
Use `docker-compose.prod.yml` for production deployment.

1. Copy `docker-compose.prod.yml` and `database/schema.sql` to production server
2. Change domain in docker compose from `us.forst.dev` to something else
3. Fill `.env`
4. Login to `ghcr.io` using your Github access token
5. `docker compose -f docker-compose.prod.yml up -d`

Traefik will automatically issue HTTPS certs and route traffic for you.

## Possible Enhancements

To make it closer to the real world, it would be better to add pagination but as this wasn't part of the assignment I
didn't do it. 
