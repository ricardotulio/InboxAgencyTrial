<?php

namespace InboxAgency\Cart\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart as CartService;
use InboxAgency\Cart\Entity\SimpleCartItem;
use InboxAgency\Catalog\Entity\Product;

/**
 * @codeCoverageIgnore
 */
class RemoveProduct
{
    private $service;

    private $view;

    public function __construct(
        CartService $service
    ) {
        $this->service = $service;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $this->service->removeProduct($data['id']);

        return $response->withRedirect('/cart/', 301);
    }
}
