<?php

namespace InboxAgency\Catalog\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Catalog\Repository\ProductRepository;

/**
 * @codeCoverageIgnore
 */
class ShowCatalog
{
    private $productRepository;
    private $view;

    public function __construct(
        ProductRepository $productRepository,
        Twig $view
    ) {
        $this->productRepository = $productRepository;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
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
