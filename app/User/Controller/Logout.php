<?php

namespace InboxAgency\User\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Service\UserServiceInterface as UserService;

/**
 * @codeCoverageIgnore
 */
class Logout
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $this->userService->logout();

        return $response->withRedirect(
            getenv('BASE_URL') . '/login/',
            301
        );
    }
}
