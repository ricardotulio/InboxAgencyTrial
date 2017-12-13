<?php

return [
    [
        'name' => 'user.login_form',
        'path' => '/login/',
        'method' => 'get',
        'controller' => 'ctrl_login_form'
    ],
    [
        'name' => 'user.login',
        'path' => '/login/',
        'method' => 'post',
        'controller' => 'ctrl_do_login'
    ],
    [
        'name' => 'user.logout',
        'path' => '/logout/',
        'method' => 'get',
        'controller' => 'ctrl_logout'
    ],
    [
        'name' => 'catalog.view',
        'path' => '/',
        'method' => 'get',
        'controller' => 'ctrl_catalog'
    ],
    [
        'name' => 'cart.add',
        'path' => '/cart/add/',
        'method' => 'post',
        'controller' => 'ctrl_cart_additem'
    ],
    [
        'name' => 'cart.remove',
        'path' => '/cart/remove/',
        'method' => 'post',
        'controller' => 'ctrl_cart_removeitem'
    ],
    [
        'name' => 'cart.view',
        'path' => '/cart/',
        'method' => 'get',
        'controller' => 'ctrl_cart_viewcart'
    ],
    [
        'name' => 'order.review',
        'path' => '/order/review/',
        'method' => 'get',
        'controller' => 'ctrl_order_review'
    ],
    [
        'name' => 'purchase.new',
        'path' => '/purchase/',
        'method' => 'post',
        'controller' => 'ctrl_purchase_new'
    ],
    [
        'name' => 'purchase.success',
        'path' => '/purchase/success/',
        'method' => 'get',
        'controller' => 'ctrl_purchase_success'
    ],
    [
        'name' => 'currency.set',
        'path' => '/currency/',
        'method' => 'post',
        'controller' => 'ctrl_currency_setcurrency'
    ],
];
