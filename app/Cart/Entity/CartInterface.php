<?php

namespace InboxAgency\Cart\Entity;

interface CartInterface
{
    public function addCartItem(CartItem $item);

    public function removeCartItem($id);

    public function getCartItems();

    public function hasItems();

    public function cleanCart();

    public function getCartAmount();
}
