<?php

namespace InboxAgency\Catalog\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Catalog\Repository\ProductRepositoryInterface;

/**
 * @codeCoverageIgnore
 */
class ShowCatalog
{
    private $productRepository;
    private $view;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        Twig $view
    ) {
        $this->productRepository = $productRepository;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $products = $this->productRepository->getList();

        return $this->view->render(
            $response,
            'catalog/product_list.html',
            [
                'products' => $products
            ]
        );
    }
}
