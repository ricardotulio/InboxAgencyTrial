<?php

namespace InboxAgency\Cart\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Catalog\Entity\Product;
use InboxAgency\Catalog\Repository\ProductRepository;
use InboxAgency\Cart\Service\Cart as CartService;
use InboxAgency\Cart\Entity\SimpleCartItem;

class AddProduct
{
    private $service;

    private $productRepository;

    public function __construct(
        CartService $service,
        ProductRepository $productRepository
    ) {
        $this->service = $service;
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $product = $this->productRepository->findById($data['id']);

        if ($product) {
            $this->service->addProduct($product);

            return $response->withRedirect('/cart/', 301);
        }

        return $response->withRedirect('/', 301);
    }
}
