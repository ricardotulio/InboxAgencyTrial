<?php

namespace InboxAgency\Cart\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\CartService;

/**
 * @codeCoverageIgnore
 */
class ViewCart
{
    private $service;

    private $view;

    public function __construct(
        CartService $service,
        Twig $view
    ) {
        $this->service = $service;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $response = $this->view->render(
            $response,
            'cart/view.html',
            [
                'cart' => $this->service->getCart()
            ]
        );

        return $response;
    }
}
