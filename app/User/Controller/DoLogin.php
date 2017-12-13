<?php

namespace InboxAgency\User\Controller;

use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Service\User as UserService;

class DoLogin
{
    private $service;

    private $view;

    public function __construct(
        UserService $service,
        Twig $view
    ) {
        $this->service = $service;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        if (!$this->service->login($data['email'], $data['password'])) {
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