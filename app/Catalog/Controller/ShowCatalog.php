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
    private $repository;
    private $view;

    public function __construct(
        ProductRepository $repository,
        Twig $view
    ) {
        $this->repository = $repository;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $products = $this->repository->getList();

        return $this->view->render(
            $response,
            'catalog/product_list.html',
            [
                'products' => $products
            ]
        );
    }
}
