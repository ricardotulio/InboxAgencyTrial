<?php

namespace InboxAgency\Cart\Entity;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private function createCartItemMock($data)
    {
        $cartItemMock = $this->createMock(CartItemInterface::class);

        if (isset($data['itemId'])) {
            $cartItemMock->method('getId')
                ->willReturn($data['itemId']);
        }

        if (isset($data['amount'])) {
            $cartItemMock->method('getItemAmount')
                ->willReturn($data['amount']);
        }

        return $cartItemMock;
    }

    /**
     * @test
     */
    public function mustAddCartItem()
    {
        $cartItem = $this->createCartItemMock(['itemId' => 10]);

        $cart = new Cart();
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

        $cartItem = $this->createCartItemMock(['itemId' => 20]);
        $cartItem->method('incrementQty');

        $cart->addCartItem($cartItem);
        $cart->addCartItem($cartItem);
    }

    /**
     * @test
     */
    public function mustRemoveCartItem()
    {
        $cartItem1 = $this->createCartItemMock(['itemId' => 57]);
        $cartItem2 = $this->createCartItemMock(['itemId' => 33]);

        $cart = new Cart();
        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);

        $cart->removeCartItem($cartItem1->getId());

        $cartItems = $cart->getCartItems();

        $this->assertFalse(isset($cartItems[$cartItem1->getId()]));
        $this->assertCount(1, $cartItems);
    }

    /**
     * @test
     */
    public function mustRetrieveCartItemById()
    {
        $cartItem = $this->createCartItemMock(['itemId' => 57]);

        $cart = new Cart();
        $cart->addCartItem($cartItem);

        $this->assertSame($cartItem, $cart->getCartItem($cartItem->getId()));
    }

    /**
     * @test
     */
    public function mustRetrieveCartItems()
    {
        $cart = new Cart();

        $cartItem1 = $this->createCartItemMock(['itemId' => 57]);
        $cartItem2 = $this->createCartItemMock(['itemId' => 33]);
        $cartItem3 = $this->createCartItemMock(['itemId' => 25]);

        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);
        $cart->addCartItem($cartItem3);

        $cartItems = $cart->getCartItems();

        $this->assertCount(
            3,
            $cartItems
        );

        $this->assertSame($cartItem1, $cartItems[$cartItem1->getId()]);
        $this->assertSame($cartItem2, $cartItems[$cartItem2->getId()]);
        $this->assertSame($cartItem3, $cartItems[$cartItem3->getId()]);
    }

    /**
     * @test
     */
    public function mustCleanCart()
    {
        $cart = new Cart();

        $cartItem1 = $this->createCartItemMock(['itemId' => 57]);
        $cartItem2 = $this->createCartItemMock(['itemId' => 33]);

        $cart->addCartItem($cartItem1);
        $cart->addCartItem($cartItem2);

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

        $cartItem1 = $this->createCartItemMock(
            [
                'itemId' => 57,
                'amount' => 20
            ]
        );

        $cartItem2 = $this->createCartItemMock(
            [
                'itemId' => 33,
                'amount' => 30
            ]
        );

        $cartItem3 = $this->createCartItemMock(
            [
                'itemId' => 25,
                'amount' => 10
            ]
        );

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

        $cartItem = $this->createCartItemMock(['itemId' => 33]);

        $this->assertFalse($cart->hasItems());

        $cart->addCartItem($cartItem);

        $this->assertTrue($cart->hasItems());
    }
}
