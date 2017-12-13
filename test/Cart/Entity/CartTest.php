<?php

namespace InboxAgency\Cart\Entity;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @test
     */
    public function mustAddCartItem()
    {
        $cart = new Cart();

        $cartItem = $this->createMock(CartItem::class);
        $cartItem->method('getId')->willReturn(10);

        $cart->addCartItem($cartItem);

        $this->assertCount(
            1,
            $cart->getCartItems()
        );
    }

    /**
     * @test
     */
    public function mustIncrementIfHasItem()
    {
        $cart = new Cart();

        $cartItem = $this->createMock(CartItem::class);
        $cartItem->method('getId')->willReturn(10);
        $cartItem->expects($this->once())->method('incrementQty');

        $cart->addCartItem($cartItem);
        $cart->addCartItem($cartItem);
    }

    /**
     * @test
     */
    public function mustRemoveCartItem()
    {
        $cartItem1Id = 57;
        $cartItem1 = $this->createMock(CartItem::class);
        $cartItem1->method('getId')->willReturn($cartItem1Id);

        $cartItem2Id = 33;
        $cartItem2 = $this->createMock(CartItem::class);
        $cartItem2->method('getId')->willReturn($cartItem2Id);

        $cart = new Cart();
        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);

        $cart->removeCartItem($cartItem1Id);

        $cartItems = $cart->getCartItems();

        $this->assertFalse(isset($cartItems[$cartItem1->getId()]));
        $this->assertCount(1, $cartItems);
    }

    /**
     * @test
     */
    public function mustRetrieveCartItems()
    {
        $cart = new Cart();

        $cartItem1Id = 57;
        $cartItem1 = $this->createMock(CartItem::class);
        $cartItem1->method('getId')->willReturn($cartItem1Id);

        $cartItem2Id = 33;
        $cartItem2 = $this->createMock(CartItem::class);
        $cartItem2->method('getId')->willReturn($cartItem2Id);

        $cartItem3Id = 10;
        $cartItem3 = $this->createMock(CartItem::class);
        $cartItem3->method('getId')->willReturn($cartItem3Id);

        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);
        $cart->addCartItem($cartItem3);

        $cartItems = $cart->getCartItems();

        $this->assertCount(
            3,
            $cartItems
        );

        $this->assertSame($cartItem1, $cartItems[$cartItem1Id]);
        $this->assertSame($cartItem2, $cartItems[$cartItem2Id]);
        $this->assertSame($cartItem3, $cartItems[$cartItem3Id]);
    }

    /**
     * @test
     */
    public function mustCleanCart()
    {
        $cart = new Cart();

        $cartItem1 = $this->createMock(CartItem::class);
        $cartItem1->method('getId')->willReturn(30);

        $cartItem2 = $this->createMock(CartItem::class);
        $cartItem2->method('getId')->willReturn(22);

        $cartItem3 = $this->createMock(CartItem::class);
        $cartItem3->method('getId')->willReturn(32);

        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);
        $cart->addCartItem($cartItem3);

        $cart->cleanCart();

        $this->assertCount(
            0,
            $cart->getCartItems()
        );
    }

    /**
     * @test
     */
    public function mustCalculateCartAmount()
    {
        $cart = new Cart();

        $cartItem1 = $this->createMock(CartItem::class);
        $cartItem1->method('getId')->willReturn(30);
        $cartItem1->method('getItemAmount')->willReturn(20);

        $cartItem2 = $this->createMock(CartItem::class);
        $cartItem2->method('getId')->willReturn(22);
        $cartItem2->method('getItemAmount')->willReturn(30);

        $cartItem3 = $this->createMock(CartItem::class);
        $cartItem3->method('getId')->willReturn(32);
        $cartItem3->method('getItemAmount')->willReturn(10);

        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);
        $cart->addCartItem($cartItem3);

        $this->assertEquals(60, $cart->getCartAmount());
    }

    /**
     * @test
     */
    public function mustVerifyIfHasItems()
    {
        $cart = new Cart();

        $cartItem = $this->createMock(CartItem::class);
        $cartItem->method('getId')->willReturn(30);

        $this->assertFalse($cart->hasItems());

        $cart->addCartItem($cartItem);

        $this->assertTrue($cart->hasItems());
    }
}
