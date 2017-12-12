<?php

namespace InboxAgency\Order\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart as CartService;

class OrderReview
{
    private $cartService;

    private $view;

    public function __construct(
        CartService $cartService,
        PhpRenderer $view
    ) {
        $this->cartService = $cartService;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $cart = $this->cartService->getCart();

        if (!$cart->hasItems()) {
            return $response->withRedirect(
                getenv('BASE_URL') . '/',
                301
            );
        }

        $cartItems = $cart->getCartItems();

        $response = $this->view->render(
            $response,
            'order/review.phtml',
            [
                'cartItems' => $cartItems,
                'total' => $cart->getCartAmount()
            ]
        );

        return $response;
    }
}
