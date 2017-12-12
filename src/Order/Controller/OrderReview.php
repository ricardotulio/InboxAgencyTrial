<?php

namespace InboxAgency\Order\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart;

class OrderReview
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
        if (!$this->cart->hasProduct()) {
            return $response->withRedirect(
                getenv('BASE_URL') . '/',
                301
            );
        }

        $products = $this->cart->getProducts();

        $response = $this->view->render(
            $response,
            'order/review.phtml',
            [
                'products' => $products
            ]
        );

        return $response;
    }
}
