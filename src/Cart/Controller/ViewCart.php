<?php

namespace InboxAgency\Cart\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart as CartService;

class ViewCart
{
    private $service;

    private $view;

    public function __construct(
        CartService $service,
        PhpRenderer $view
    ) {
        $this->service = $service;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $cart = $this->service->getCart();
        $cartItems = $cart->getCartItems();

        $response = $this->view->render(
            $response,
            'cart/view.phtml',
            [
                'cartItems' => $cartItems
            ]
        );

        return $response;
    }
}
