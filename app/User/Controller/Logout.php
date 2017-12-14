<?php

namespace InboxAgency\User\Controller;

use Psr\Http\Message\ServerRequestInterface;;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\User\Service\UserServiceInterface;

/**
 * @codeCoverageIgnore
 */
class Logout
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $this->userService->logout();

        return $response->withRedirect(
            getenv('BASE_URL') . '/login/',
            301
        );
    }
}
