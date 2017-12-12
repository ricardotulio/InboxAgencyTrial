<?php

namespace InboxAgency\Cart\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Catalog\Entity\Product;
use InboxAgency\Cart\Service\Cart as CartService;
use InboxAgency\Cart\Entity\SimpleCartItem;

class AddProduct
{
    private $service;

    private $view;

    public function __construct(
        CartService $service,
        PhpRenderer $view
    ) {
        $this->service = $service;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $product = new Product();
        $product->fromArray($data);

        $cartItem = new SimpleCartItem($product);

        $cart = $this->service->getCart();
        $cart->addCartItem($cartItem);

        $this->service->persistCart($cart);

        return $response->withRedirect('/cart/', 301);
    }
}
