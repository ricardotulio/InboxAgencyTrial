<?php

namespace InboxAgency\Cart\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Cart\Service\CartServiceInterface;

/**
 * @codeCoverageIgnore
 */
class RemoveProduct
{
    private $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $data = $request->getParsedBody();

        $this->cartService->removeProduct($data['id']);

        return $response->withRedirect('/cart/', 301);
    }
}
