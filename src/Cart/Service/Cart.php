<?php

namespace InboxAgency\Cart\Service;

interface Cart
{
    public function hasProduct();

    public function addProduct($product);

    public function removeProduct($product);

    public function getProducts();

    public function cleanCart();

    public function getTotalAmount();
}
