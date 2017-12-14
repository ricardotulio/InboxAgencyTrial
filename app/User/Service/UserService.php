<?php

namespace InboxAgency\User\Service;

use InboxAgency\Session\SessionInterface;
use InboxAgency\User\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    private $session;

    private $repository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        SessionInterface $session,
        UserRepositoryInterface $repository
    ) {
        $this->session = $session;
        $this->repository = $repository;
    }

    public function login($email, $password)
    {
        $user = $this->repository->findByEmail($email);

        if ($user && $user->authenticate($password)) {
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
