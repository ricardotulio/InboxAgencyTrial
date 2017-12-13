<?php

namespace InboxAgency\Cart\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\CartServiceInterface as CartService;

/**
 * @codeCoverageIgnore
 */
class RemoveProduct
{
    private $cartService;

    private $view;

    public function __construct(
        CartService $cartService
    ) {
        $this->cartService = $cartService;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $this->cartService->removeProduct($data['id']);

        return $response->withRedirect('/cart/', 301);
    }
}
