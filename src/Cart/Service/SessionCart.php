<?php

namespace InboxAgency\Cart\Service;

use InboxAgency\Catalog\Entity\Product;
use InboxAgency\Cart\Entity\Cart as CartEntity;
use InboxAgency\Cart\Entity\SimpleCart as SimpleCartEntity;

class SessionCart implements Cart
{
    public function getCart()
    {
        if (isset($_SESSION['cart'])) {
            return unserialize($_SESSION['cart']);
        }

        return new SimpleCartEntity();
    }

    public function persistCart(CartEntity $cart)
    {
        $_SESSION['cart'] = serialize($cart);
    }
}
