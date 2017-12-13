<?php

namespace InboxAgency\Cart\Entity;

use InboxAgency\Catalog\Entity\Product;

interface CartItem
{
    public function __construct(Product $product, $qty);

    public function getId();

    public function getProduct();

    public function getQty();

    public function incrementQty();

    public function getProductPrice();

    public function getItemAmount();
}
