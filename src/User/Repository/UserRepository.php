<?php

namespace InboxAgency\User\Repository;

interface UserRepository
{
    public function findByEmail($email);
}
