<?php

namespace InboxAgency\Cart\Entity;

class Cart implements CartInterface
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addCartItem(CartItemInterface $item)
    {
        if (!isset($this->items[$item->getId()])) {
            return $this->items[$item->getId()] = $item;
        }

        return $this->items[$item->getId()]->incrementQty();
    }

    public function removeCartItem($id)
    {
        unset($this->items[$id]);
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
