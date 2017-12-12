<?php

session_start();

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Controller\Login\Get as LoginGet;

require_once __DIR__ . '/../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

$container = new \Slim\Container($configuration);
$app = new \Slim\App($container);

$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'host' => getenv('DB_HOST'),
    'driver' => 'pdo_mysql',
);

$container['conn'] = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$container['view'] = new \Slim\Views\PhpRenderer("../src/views/");

$app->get(
    '/login/',
    new InboxAgency\User\Controller\Login\LoginForm(
        $container->get('view')
    )
);

$app->post(
    '/login/',
    new InboxAgency\User\Controller\Login\DoLogin(
        new InboxAgency\User\Repository\DBALUserRepository(
            $container->get('conn')
        ),
        $container->get('view')
    )
);

$app->get(
    '/',
    new InboxAgency\Catalog\Controller\Catalog\Catalog(
        new InboxAgency\Catalog\Repository\DBALProductRepository(
            $container->get('conn')
        ),
        $container->get('view')
    )
);

$app->post(
    '/cart/add/',
    new InboxAgency\Cart\Controller\Cart\AddProduct(
        new InboxAgency\Cart\Service\SessionCart(),
        $container->get('view')
    )
);

$app->post(
    '/cart/remove/',
    new InboxAgency\Cart\Controller\Cart\RemoveProduct(
        new InboxAgency\Cart\Service\SessionCart(),
        $container->get('view')
    )
);

$app->get(
    '/order/review/',
    new InboxAgency\Order\Controller\OrderReview\Review(
        new InboxAgency\Cart\Service\SessionCart(),
        $container->get('view')
    )
);

$app->run();
