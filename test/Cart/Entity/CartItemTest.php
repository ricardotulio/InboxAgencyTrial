<?php

namespace InboxAgency\Cart\Entity;

use PHPUnit\Framework\TestCase;
use InboxAgency\Cart\Entity\CartItem;
use InboxAgency\Catalog\Entity\ProductInterface;

class CartItemTest extends TestCase
{
    /**
     * @test
     */
    public function mustReturnProductPrice()
    {
        $price = 15.0;

        $product = $this->createMock(ProductInterface::class);
        $product->method('getPrice')->willReturn($price);

        $cartItem = new CartItem($product);

        $this->assertEquals($price, $cartItem->getProductPrice());
    }

    /**
     * @test
     */
    public function mustIncrementQty()
    {
        $product = $this->createMock(ProductInterface::class);

        $cartItem = new CartItem($product);
        $cartItem->incrementQty();

        $this->assertEquals(2, $cartItem->getQty());
    }

    /**
     * @test
     */
    public function mustCalculateItemAmount()
    {
        $price = 15.0;
        $qty = 3;
        $expectedAmount = $qty * $price;

        $product = $this->createMock(ProductInterface::class);
        $product->method('getPrice')->willReturn($price);

        $cartItem = new CartItem($product, $qty);

        $this->assertEquals($expectedAmount, $cartItem->getItemAmount());
    }
}
