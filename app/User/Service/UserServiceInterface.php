<?php

namespace InboxAgency\User\Service;

interface UserServiceInterface
{
    public function login($email, $password);

    public function logout();
}
