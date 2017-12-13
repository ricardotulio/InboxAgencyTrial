<?php

namespace InboxAgency\Cart\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Catalog\Entity\Product;
use InboxAgency\Catalog\Repository\ProductRepository;
use InboxAgency\Cart\Service\CartServiceInterface as CartService;

/**
 * @codeCoverageIgnore
 */
class AddProduct
{
    private $cartService;

    private $productRepository;

    public function __construct(
        CartService $cartService,
        ProductRepository $productRepository
    ) {
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $product = $this->productRepository->findById($data['id']);

        if ($product) {
            $this->cartService->addProduct($product);

            return $response->withRedirect('/cart/', 301);
        }

        return $response->withRedirect('/', 301);
    }
}
