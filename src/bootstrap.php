<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../config/container.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$app = $container->get('app');

$authorizator = new InboxAgency\User\Middleware\Authorizator(
    new InboxAgency\User\Service\SessionAuthorizator()
);

$app->add($authorizator);

foreach ($routes as $route) {
    $app->$route['method']($route['path'], $route['controller'])->setName($route['name']);
}

$app->run();
