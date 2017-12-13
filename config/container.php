<?php

$config = require_once __DIR__ . '/config.php';

$container = new \Slim\Container($config['container']);

$container['conn'] = \Doctrine\DBAL\DriverManager::getConnection(
    $config['database'],
    new \Doctrine\DBAL\Configuration()
);

$container['view'] = function($container) use ($config) {
    $view = new \Slim\Views\Twig($config['view']['paths'], [
        'cache' => $config['view']['cache']
    ]);

    $view->addExtension(
        new \Slim\Views\TwigExtension(
            $container['router'],
            $config['app']['base_path']
        )
    );

    return $view;
};

$container['user_repository'] = function($container) {
    return new \InboxAgency\User\Repository\DBALUserRepository(
        $container->get('conn')
    );
};

$container['product_repository'] = function($container) {
    return new \InboxAgency\Catalog\Repository\DBALProductRepository(
        $container->get('conn')
    );
};

$container['service_cart'] = function($container) {
    return new InboxAgency\Cart\Service\CartService(
        $container->get('session')
    );
};

$container['service_user'] = function($container) {
    return new InboxAgency\User\Service\User(
        $container->get('session'),
        $container->get('user_repository')
    );
};

$container['service_currency'] = function($container) {
    return new InboxAgency\Currency\Service\CurrencyService(
        $container->get('session')
    );
};

$container['qeue_connection'] = function($container) use ($config) {
    return new PhpAmqpLib\Connection\AMQPStreamConnection(
        $config['qeue']['host'],
        $config['qeue']['port'],
        $config['qeue']['user'],
        $config['qeue']['pass']
    );
};

$container['service_purchase'] = function($container) {
    return new InboxAgency\Purchase\Service\PurchaseService(
        $container->get('qeue_connection'),
        $container->get('view')
    );
};

$container['ctrl_login_form'] = function($container) {
    return new \InboxAgency\User\Controller\LoginForm(
        $container->get('view')
    );
};

$container['ctrl_do_login'] = function($container) {
    return new \InboxAgency\User\Controller\DoLogin(
        $container->get('service_user'),
        $container->get('view')
    );
};

$container['ctrl_logout'] = function($container) {
    return new InboxAgency\User\Controller\Logout(
        $container->get('service_user')
    );
};

$container['ctrl_catalog'] = function($container) {
    return new InboxAgency\Catalog\Controller\ShowCatalog(
        new InboxAgency\Catalog\Repository\DBALProductRepository(
            $container->get('conn')
        ),
        $container->get('view')
    );
};

$container['ctrl_cart_additem'] = function($container) {
    return new InboxAgency\Cart\Controller\AddProduct(
        $container->get('service_cart'),
        $container->get('product_repository')
    );
};

$container['ctrl_cart_removeitem'] = function($container) {
    return new InboxAgency\Cart\Controller\RemoveProduct(
        $container->get('service_cart'),
        $container->get('view')
    );
};

$container['ctrl_cart_viewcart'] = function($container) {
    return new InboxAgency\Cart\Controller\ViewCart(
        $container->get('service_cart'),
        $container->get('view')
    );
};

$container['ctrl_order_review'] = function($container) {
    return new InboxAgency\Order\Controller\OrderReview(
        $container->get('service_cart'),
        $container->get('view')
    );
};

$container['ctrl_purchase_new'] = function($container) {
    return new InboxAgency\Purchase\Controller\NewPurchase(
        $container->get('service_cart'),
        $container->get('service_purchase'),
        $container->get('view')
    );
};

$container['ctrl_purchase_success'] = function($container) {
    return new InboxAgency\Purchase\Controller\SuccessPage(
        $container->get('view')
    );
};

$container['ctrl_currency_setcurrency'] = function($container) {
    return new InboxAgency\Currency\Controller\SetCurrency(
        $container->get('service_currency')
    );
};

$container['app'] = function($container) {
    return new \Slim\App($container);
};

$container['session'] = function($container) {
    return new \InboxAgency\Session\PhpSession();
};

return $container;
