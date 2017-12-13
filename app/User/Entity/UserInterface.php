<?php

namespace InboxAgency\User\Entity;

interface UserInterface
{
    public function getId();

    public function getEmail();

    public function getPassword();

    public function getCreated();

    public function getUpdated();

    public function encrypt($password);

    public function authenticate($password);
}
