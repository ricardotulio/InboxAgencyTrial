<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../config/container.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$twigEnvironment = $container->get('view')->getEnvironment();

$currency = new \Twig_SimpleFilter('currency', function($string) use ($container) {
    $currency = $container->get('service_currency')->get();

    $exchangedValue = floatval($string) * $currency['rate'];

    return $currency['symbol'] . ' ' . number_format($exchangedValue, 2, '.', ',');
});

$twigEnvironment->addFilter($currency);

$app = $container->get('app');

$app->add(new InboxAgency\User\Middleware\Authorizator(
    new InboxAgency\User\Service\SessionAuthorizator()
));

$app->add(new InboxAgency\Session\SessionMiddleware(
    $container->get('session')
));

foreach ($routes as $route) {
    $app->$route['method']($route['path'], $route['controller'])
        ->setName($route['name']);
}

$app->run();
