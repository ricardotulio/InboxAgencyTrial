<?php

namespace InboxAgency\Cart\Entity;

class SimpleCart implements Cart
{
    private $items;
    
    public function __construct()
    {
        $this->items = [];
    }

    public function addCartItem(CartItem $item)
    {
        $this->items[$item->getId()] = $item;
    }

    public function removeCartItem(CartItem $item)
    {
        unset($this->items[$item->getId()]);
    }

    public function getCartItems()
    {
        return $this->items;
    }

    public function hasItems()
    {
        return count($this->items) > 0;
    }

    public function cleanCart()
    {
        $this->items = [];
    }

    public function getCartAmount()
    {
        $amount = 0;

        foreach ($this->getCartItems() as $item) {
            $amount += $item->getItemAmount();
        }

        return $amount;
    }
}