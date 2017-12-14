<?php

namespace InboxAgency\Order\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Cart\Service\CartServiceInterface;

/**
 * @codeCoverageIgnore
 */
class OrderReview
{
    private $cartService;

    private $view;

    public function __construct(
        CartServiceInterface $cartService,
        Twig $view
    ) {
        $this->cartService = $cartService;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
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
