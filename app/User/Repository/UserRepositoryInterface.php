<?php

namespace InboxAgency\User\Repository;

interface UserRepositoryInterface
{
    public function findByEmail($email);
}
