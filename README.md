# Inbox Agency Trial Challenge

The propose of this project is provide an webstore containing a basic login, home page and purchase page.

## Running this project

To run this project just run commands below:

```
$ docker-compose up -d
$ docker-compose run composer install
$ docker-compose exec php vendor/bin/phinx migrate
$ docker-compose exec php vendor/bin/phinx seed:run
```

## Code Sniffer

To run the Code Sniffer, just exec `vendor/bin/phpcs --standard=PSR2 src/`.

## Mess Detector

To run the Code Sniffer, just exec `vendor/bin/phpmd src/ text cleancode`.

## Testing

To run the project tests, just exec `/vendor/bin/phpunit`.
