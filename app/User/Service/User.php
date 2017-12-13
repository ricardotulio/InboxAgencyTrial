<?php

namespace InboxAgency\User\Service;

use InboxAgency\Session\Session;
use InboxAgency\User\Repository\UserRepository;

class User
{
    private $session;

    private $repository;

    public function __construct(
        Session $session,
        UserRepository $repository
    ) {
        $this->session = $session;
        $this->repository = $repository;
    }

    public function login($email, $password)
    {
        $user = $this->repository->findByEmail($email);

        if ($user->authenticate($password)) {
            $this->session->set('user', $user);
            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->session->destroy();
    }
}
