<?php

namespace InboxAgency\User\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Service\User as UserService;

/**
 * @codeCoverageIgnore
 */
class Logout
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $this->service->logout();

        return $response->withRedirect(
            getenv('BASE_URL') . '/login/',
            301
        );
    }
}
