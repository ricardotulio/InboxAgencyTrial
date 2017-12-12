<?php

namespace InboxAgency\Cart\Service;

use InboxAgency\Cart\Entity\Cart as CartEntity;

interface Cart
{
    public function getCart();

    public function persistCart(CartEntity $cart);
}
