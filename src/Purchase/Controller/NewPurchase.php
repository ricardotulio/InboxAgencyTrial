<?php

namespace InboxAgency\Purchase\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;
use InboxAgency\Cart\Service\Cart;
use InboxAgency\Purchase\Service\Purchase as PurchaseService;

class NewPurchase
{
    private $cart;
    private $view;

    public function __construct(
        Cart $cart,
        PurchaseService $service,
        PhpRenderer $view
    ) {
        $this->cart = $cart;
        $this->service = $service;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        if (!$this->cart->hasProduct()) {
            return $response->withRedirect(
                getenv('BASE_URL') . '/',
                301
            );
        }

        $products = $this->cart->getProducts();
        $this->cart->cleanCart();

        $this->service->sendEmail();
        die();

        return $response->withRedirect(
            getenv('BASE_URL') . '/purchase/success/',
            301
        );
    }
}
