<?php

namespace InboxAgency\Purchase\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class SuccessPage
{
    private $view;

    public function __construct(PhpRenderer $view) 
    {
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response)
    {
        $response = $this->view->render($response, 'purchase/success.phtml');
        return $response;
    }
}


