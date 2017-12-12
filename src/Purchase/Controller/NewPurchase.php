<?php

namespace InboxAgency\Purchase\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;
use InboxAgency\Cart\Service\Cart;

class NewPurchase
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

    public function __invoke(Request $request, Response $response)
    {
        $this->cart->cleanCart();

        return $response->withRedirect(
            getenv('BASE_URL') . '/purchase/success/', 
            301
        );
    }
}
