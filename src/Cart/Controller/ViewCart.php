<?php

namespace InboxAgency\Cart\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart;

class ViewCart
{
    private $cart;

    private $view;

    public function __construct(
        Cart $cart,
        PhpRenderer $view
    ) {
        $this->cart = $cart;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $products = $this->cart->getProducts();

        $response = $this->view->render(
            $response,
            'cart/view.phtml',
            [
                'products' => $products
            ]
        );

        return $response;
    }
}
