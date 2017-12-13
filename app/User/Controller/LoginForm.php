<?php

namespace InboxAgency\User\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * @codeCoverageIgnore
 */
class LoginForm
{
    private $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        return $this->view->render($response, 'user/login.html');
    }
}
