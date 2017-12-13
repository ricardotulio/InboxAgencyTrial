<?php

namespace InboxAgency\Cart\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\Session;
use InboxAgency\Cart\Entity\Cart;
use inboxAgency\Catalog\Entity\ProductInterface;

class CartServiceTest extends TestCase
{
    /**
     * @test
     */
    public function mustCreateNewCartIfHasNoCartIntoSession()
    {
        $session = $this->createMock(Session::class);
        $cartService = new CartService($session);
        $cart = $cartService->getCart();

        $this->assertInstanceOf(\InboxAgency\Cart\Entity\Cart::class, $cart);
    }

    /**
     * @test
     */
    public function mustRetrieveCartFromSession()
    {
        $session = $this->createMock(Session::class);
        $cartService = new CartService($session);

        $cart = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $this->assertSame($cart, $cartService->getCart());
    }

    /**
     * @test
     */
    public function mustAddProductToCart()
    {
        $session = $this->createMock(Session::class);
        $cart = $this->createMock(Cart::class);
        $product = $this->createMock(ProductInterface::class);

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $session->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('cart'),
                $this->equalTo($cart)
            );

        $cart->expects($this->once())
            ->method('addCartItem');

        $product->method('getId')
            ->willReturn(10);

        $cartService = new CartService($session);
        $cartService->addProduct($product);
    }


    /**
     * @test
     */
    public function mustVerifyIfHasItems()
    {
        $session = $this->createMock(Session::class);
        $cart = $this->createMock(Cart::class);

        $cart->expects($this->once())
            ->method('hasItems')
            ->willReturn(true);

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $cartService = new CartService($session);

        $this->assertTrue($cartService->hasItems());
    }

    /**
     * @test
     */
    public function mustRemoveItem()
    {
        $itemId = 10;

        $session = $this->createMock(Session::class);
        $cart = $this->createMock(Cart::class);

        $cart->expects($this->once())
            ->method('removeCartItem')
            ->with($this->equalTo($itemId));

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $cartService = new CartService($session);
        $cartService->removeProduct($itemId);
    }

    /**
     * @test
     */
    public function mustCleanCart()
    {
        $session = $this->createMock(Session::class);
        $cart = $this->createMock(Cart::class);

        $cart->expects($this->once())
            ->method('cleanCart');

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $cartService = new CartService($session);
        $cartService->cleanCart();
    }
}
