<?php

namespace InboxAgency\Purchase\Entity;

use InboxAgency\User\Entity\User;
use InboxAgency\Cart\Entity\Cart;

class Purchase implements PurchaseInterface
{
    private $id;

    private $user;

    private $cart;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(User $user, Cart $cart)
    {
        $this->user = $user;
        $this->cart = $cart;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getCart()
    {
        return $this->cart;
    }
}
