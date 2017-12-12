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

$container['service_cart'] = function($container) {
    return new InboxAgency\Cart\Service\SessionCart();
};

$container['service_purchase'] = function($container) {
    return new InboxAgency\Purchase\Service\Purchase();
};

$container['ctrl_login_form'] = function($container) {
    return new \InboxAgency\User\Controller\LoginForm(
        $container->get('view')
    );
};

$container['ctrl_do_login'] = function($container) {
    return new \InboxAgency\User\Controller\DoLogin(
        $container->get('user_repository'),
        $container->get('view')
    );
};

$container['ctrl_logout'] = function($container) {
    return new InboxAgency\User\Controller\Logout();
};

$container['ctrl_catalog'] = function($container) {
    return new InboxAgency\Catalog\Controller\Catalog\Catalog(
        new InboxAgency\Catalog\Repository\DBALProductRepository(
            $container->get('conn')
        ),
        $container->get('view')
    );
};

$container['ctrl_cart_additem'] = function($container) {
    return new InboxAgency\Cart\Controller\AddProduct(
        $container->get('service_cart')
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

$container['app'] = function($container) {
    return new \Slim\App($container);
};

return $container;
