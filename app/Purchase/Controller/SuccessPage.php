<?php

namespace InboxAgency\Purchase\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class SuccessPage
{
    private $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response)
    {
        $response = $this->view->render($response, 'purchase/success.html');
        return $response;
    }
}
