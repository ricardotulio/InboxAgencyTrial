<?php

namespace InboxAgency\Order\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart as CartService;

class OrderReview
{
    private $cartService;

    private $view;

    public function __construct(
        CartService $cartService,
        Twig $view
    ) {
        $this->cartService = $cartService;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        if (!$this->cartService->hasItems()) {
            return $response->withRedirect(
                getenv('BASE_URL') . '/',
                301
            );
        }

        return $this->view->render(
            $response,
            'order/review.html',
            [
                'cart' => $this->cartService->getCart()
            ]
        );
    }
}
