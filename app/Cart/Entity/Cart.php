<?php

namespace InboxAgency\Cart\Entity;

interface Cart
{
    public function addCartItem(CartItem $item);

    public function removeCartItem($id);

    public function getCartItems();

    public function hasItems();

    public function cleanCart();

    public function getCartAmount();
}
