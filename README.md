# Inbox Agency Trial Challenge

[![Build Status](https://travis-ci.org/ricardotulio/InboxAgencyTrial.svg?branch=master)](https://travis-ci.org/ricardotulio/InboxAgencyTrial) [![Coverage Status](https://coveralls.io/repos/github/ricardotulio/InboxAgencyTrial/badge.svg?branch=master)](https://coveralls.io/github/ricardotulio/InboxAgencyTrial?branch=master) [![Maintainability](https://api.codeclimate.com/v1/badges/7b8118df908b57913483/maintainability)](https://codeclimate.com/github/ricardotulio/InboxAgencyTrial/maintainability)

The propose of this project is provide an webstore containing a basic login, home page and purchase page.

## Dependencies

- docker (>= 17.09.*)
- dockcer-compose (>= 1.8.0)

## Running this project

First, copy `.env.example` to `.env` and set smtp environments.

##### Receiving email from application

If you wanto to receive emails sent by worker, configure SMTP using a valid Gmail account and configure yours security settings into (https://myaccount.google.com/?utm_source=OGB&utm_medium=app&pli=1). You can find how to configurate in (https://www.formget.com/send-email-via-gmail-smtp-server-in-php/) on session "Change in Gmail settings:". Also use a valid e-mail into db/seeds/UserSeeder.php.

***

After this, just run commands below:

```
$ docker-compose build
$ docker-compose run composer install
$ docker-compose up -d
$ docker-compose exec php vendor/bin/phinx migrate
$ docker-compose exec php vendor/bin/phinx seed:run
```

After this, access `http://localhost:8080` using email `teste@teste.com` and password `123456`.

## Checking emails sent by the worker

`$ docker-compose logs -f mail_worker`

## Code Sniffer

`$ docker-compose exec php vendor/bin/phpcs --standard=PSR2 app/`

## Mess Detector

`$ docker-compose exec php vendor/bin/phpmd app/ text cleancode`

## Testing

`$ docker-compose exec php vendor/bin/phpunit`
