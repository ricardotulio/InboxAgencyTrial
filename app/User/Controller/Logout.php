<?php

namespace InboxAgency\User\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Repository\UserRepository;

class Logout
{
    public function __invoke(
        Request $request,
        Response $response
    ) {
        $_SESSION = [];

        return $response->withRedirect(
            getenv('BASE_URL') . '/login/',
            301
        );
    }
}
