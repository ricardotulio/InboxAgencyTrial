<?php

namespace InboxAgency\Cart\Entity;

use InboxAgency\Catalog\Entity\Product;

class SimpleCartItem implements CartItem
{
    private $id;

    private $product;

    private $qty;

    public function __construct(Product $product, $qty = 1)
    {
        $this->id = $product->getId();
        $this->product = $product;
        $this->qty = $qty;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function incrementQty()
    {
        $this->qty++;
    }

    public function getProductPrice()
    {
        return $this->getProduct()->getPrice();
    }

    public function getItemAmount()
    {
        return $this->getQty() * $this->getProductPrice();
    }
}
