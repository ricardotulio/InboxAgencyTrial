<?php

namespace InboxAgency\User\Entity;

class User
{
    private $id;

    private $email;

    private $password;

    private $created;

    private $updated;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $this->encrypt($password);
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    public function fromArray($array)
    {
        $this->setId($array['id']);
        $this->setEmail($array['email']);
        $this->setCreated($array['created']);
        $this->setUpdated($array['updated']);
        $this->password = $array['password'];
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated()
        ];
    }

    public function encrypt($password)
    {
        return sha1($password);
    }

    public function authenticate($password)
    {
        return $this->getPassword() == $this->encrypt($password);
    }
}
