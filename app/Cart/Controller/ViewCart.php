<?php

namespace InboxAgency\Cart\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Cart\Service\CartServiceInterface;

/**
 * @codeCoverageIgnore
 */
class ViewCart
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
        $response = $this->view->render(
            $response,
            'cart/view.html',
            [
                'cart' => $this->cartService->getCart()
            ]
        );

        return $response;
    }
}
