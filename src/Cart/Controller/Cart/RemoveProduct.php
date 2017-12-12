<?php

namespace InboxAgency\Cart\Controller\Cart;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart;
use InboxAgency\Catalog\Entity\Product;

class RemoveProduct
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

    public function __invoke(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $product = new Product();
        $product->fromArray($data);

        $this->cart->removeProduct($product);

        return $response->withRedirect('/cart/', 301);
    }
}