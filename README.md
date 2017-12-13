# Inbox Agency Trial Challenge

[![Build Status](https://travis-ci.org/ricardotulio/InboxAgencyTrail.svg?branch=master)](https://travis-ci.org/ricardotulio/InboxAgencyTrail) [![Coverage Status](https://coveralls.io/repos/github/ricardotulio/InboxAgencyTrail/badge.svg?branch=master)](https://coveralls.io/github/ricardotulio/InboxAgencyTrail?branch=master) [![Maintainability](https://api.codeclimate.com/v1/badges/7b8118df908b57913483/maintainability)](https://codeclimate.com/github/ricardotulio/InboxAgencyTrail/maintainability)

The propose of this project is provide an webstore containing a basic login, home page and purchase page.

## Dependencies

- docker (>= 17.09.*)
- dockcer-compose (>= 1.8.0)

## Running this project

First, copy `.env.example` to `.env` and set smtp environments. Prefer to use gmail account.

After this, just run commands below:

```
$ docker-compose build
$ docker-compose run composer install
$ docker-compose up -d
$ docker-compose exec php vendor/bin/phinx migrate
$ docker-compose exec php vendor/bin/phinx seed:run
```

After this, access `http://localhost:8088`.

## Checking emails sent by the worker

`docker-compose logs -f mail_worker`

## Code Sniffer

`vendor/bin/phpcs --standard=PSR2 app/`

## Mess Detector

`vendor/bin/phpmd app/ text cleancode`

## Testing

`/vendor/bin/phpunit`
