<?php

namespace InboxAgency\User\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Repository\UserRepository;

class DoLogin
{
    private $repository;
    private $view;

    public function __construct(
        UserRepository $repository,
        PhpRenderer $view
    ) {
        $this->repository = $repository;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();
        $user = $this->repository->findByEmail($data['email']);

        if (!$user || !$user->authenticate($data['password'])) {
            return $this->view->render(
                $response,
                'user/login.phtml',
                [
                    'loginError' => 'E-mail e/ou senha inválidos.'
                ]
            );
        }

        return $response->withRedirect(
            getenv('BASE_URL') . '/',
            301
        );
    }
}
