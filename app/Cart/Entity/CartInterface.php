<?php

namespace InboxAgency\Cart\Entity;

interface CartInterface
{
    public function addCartItem(CartItemInterface $item);

    public function removeCartItem($itemId);

    public function getCartItem($itemId);

    public function getCartItems();

    public function hasItems();

    public function cleanCart();

    public function getCartAmount();
}
