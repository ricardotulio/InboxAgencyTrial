<?php

namespace InboxAgency\Cart\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Catalog\Entity\Product;
use InboxAgency\Catalog\Repository\ProductRepositoryInterface;
use InboxAgency\Cart\Service\CartServiceInterface;

/**
 * @codeCoverageIgnore
 */
class AddProduct
{
    private $cartService;

    private $productRepository;

    public function __construct(
        CartServiceInterface $cartService,
        ProductRepositoryInterface $productRepository
    ) {
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
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
