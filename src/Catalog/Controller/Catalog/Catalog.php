<?php

namespace InboxAgency\Catalog\Controller\Catalog;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Catalog\Repository\ProductRepository;

class Catalog
{
    private $repository;
    private $view;

    public function __construct(
        ProductRepository $repository,
        PhpRenderer $view
    ) {
        $this->repository = $repository;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response)
    {
        $products = $this->repository->getList();

        return $this->view->render(
            $response,
            'catalog/product_list.phtml',
            [
                'products' => $products
            ]
        );
    }
}
