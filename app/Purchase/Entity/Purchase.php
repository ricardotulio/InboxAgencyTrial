<?php

namespace InboxAgency\Purchase\Entity;

use InboxAgency\User\Entity\UserInterface;
use InboxAgency\Cart\Entity\CartInterface;

class Purchase implements PurchaseInterface
{
    private $id;

    private $user;

    private $cart;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        UserInterface $user,
        CartInterface $cart
    ) {
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
