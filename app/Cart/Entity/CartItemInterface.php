<?php

namespace InboxAgency\Cart\Entity;

use InboxAgency\Catalog\Entity\ProductInterface;

interface CartItemInterface
{
    public function __construct(ProductInterface $product, $qty);

    public function getId();

    public function getProduct();

    public function getQty();

    public function incrementQty();

    public function getProductPrice();

    public function getItemAmount();
}
