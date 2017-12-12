<?php

namespace InboxAgency\User\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LoginForm
{
    private $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        return $this->view->render($response, 'user/login.phtml');
    }
}
