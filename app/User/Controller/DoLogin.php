<?php

namespace InboxAgency\User\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\User\Service\UserServiceInterface;

/**
 * @codeCoverageIgnore
 */
class DoLogin
{
    private $userService;

    private $view;

    public function __construct(
        UserServiceInterface $userService,
        Twig $view
    ) {
        $this->userService = $userService;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $data = $request->getParsedBody();

        if (!$this->userService->login($data['email'], $data['password'])) {
            return $this->view->render(
                $response,
                'user/login.html',
                [
                    'loginError' => 'Invalid e-mail and password.'
                ]
            );
        }

        return $response->withRedirect(
            getenv('BASE_URL') . '/',
            301
        );
    }
}
