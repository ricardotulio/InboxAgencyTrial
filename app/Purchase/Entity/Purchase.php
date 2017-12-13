<?php

namespace InboxAgency\Purchase\Entity;

use InboxAgency\User\Entity\User;
use InboxAgency\Cart\Entity\Cart;

class Purchase
{
    private $id;

    private $user;

    private $cart;

    public function __construct(User $user, Cart $cart)
    {
        $this->user = $user;
        $this->cart = $cart;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getCart()
    {
        return $this->cart;
    }
}
