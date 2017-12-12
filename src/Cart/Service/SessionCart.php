<?php

namespace InboxAgency\Cart\Service;

use InboxAgency\Catalog\Entity\Product;

class SessionCart implements Cart
{
    public function addProduct($product)
    {
        $_SESSION['cart'][$product->getId()] = $product->toArray();
    }

    public function getProducts()
    {
        $products = [];

        foreach ($_SESSION['cart'] as $productData) {
            $product = new Product();
            $product->fromArray($productData);

            $products[$product->getId()] = $product;
        }

        return $products;
    }

    public function removeProduct($product)
    {
        unset($_SESSION['cart'][$product->getId()]);
    }

    public function cleanCart()
    {
        $_SESSION['cart'] = [];
    }
}
