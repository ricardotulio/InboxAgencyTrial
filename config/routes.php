<?php

return [
    [
        'path' => '/login/',
        'method' => 'get',
        'controller' => 'ctrl_login_form'
    ],
    [
        'path' => '/login/',
        'method' => 'post',
        'controller' => 'ctrl_do_login'
    ],
    [
        'path' => '/logout/',
        'method' => 'get',
        'controller' => 'ctrl_logout'
    ],
    [
        'path' => '/',
        'method' => 'get',
        'controller' => 'ctrl_catalog'
    ],
    [
        'path' => '/cart/add/',
        'method' => 'post',
        'controller' => 'ctrl_cart_additem'
    ],
    [
        'path' => '/cart/remove/',
        'method' => 'post',
        'controller' => 'ctrl_cart_removeitem'
    ],
    [
        'path' => '/cart/',
        'method' => 'get',
        'controller' => 'ctrl_cart_viewcart'
    ],
    [
        'path' => '/order/review/',
        'method' => 'get',
        'controller' => 'ctrl_order_review'
    ],
    [
        'path' => '/purchase/',
        'method' => 'post',
        'controller' => 'ctrl_purchase_new'
    ],
    [
        'path' => '/purchase/success/',
        'method' => 'get',
        'controller' => 'ctrl_purchase_success'
    ],
];
