<?php

namespace InboxAgency\Cart\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\Session;
use InboxAgency\Cart\Entity\Cart as CartEntity;
use inboxAgency\Catalog\Entity\Product;

class CartTest extends TestCase
{
    /**
     * @test
     */
    public function mustCreateNewCartIfHasNoCartIntoSession()
    {
        $session = $this->createMock(Session::class);
        $service = new Cart($session);
        $cart = $service->getCart();

        $this->assertInstanceOf(\InboxAgency\Cart\Entity\Cart::class, $cart);
    }

    /**
     * @test
     */
    public function mustRetrieveCartFromSession()
    {
        $session = $this->createMock(Session::class);
        $service = new Cart($session);

        $cart = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $this->assertSame($cart, $service->getCart());
    }

    /**
     * @test
     */
    public function mustAddProductToCart()
    {
        $session = $this->createMock(Session::class);
        $cart = $this->createMock(CartEntity::class);
        $product = $this->createMock(Product::class);

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

        $service = new Cart($session);
        $service->addProduct($product);
    }


    /**
     * @test
     */
    public function mustVerifyIfHasItems()
    {
        $session = $this->createMock(Session::class);
        $cart = $this->createMock(CartEntity::class);

        $cart->expects($this->once())
            ->method('hasItems')
            ->willReturn(true);

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $service = new Cart($session);

        $this->assertTrue($service->hasItems());
    }

    /**
     * @test
     */
    public function mustRemoveItem()
    {
        $itemId = 10;

        $session = $this->createMock(Session::class);
        $cart = $this->createMock(CartEntity::class);

        $cart->expects($this->once())
            ->method('removeCartItem')
            ->with($this->equalTo($itemId));

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $service = new Cart($session);
        $service->removeProduct($itemId);
    }

    /**
     * @test
     */
    public function mustCleanCart()
    {
        $session = $this->createMock(Session::class);
        $cart = $this->createMock(CartEntity::class);

        $cart->expects($this->once())
            ->method('cleanCart');

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('cart'))
            ->willReturn($cart);

        $service = new Cart($session);
        $service->cleanCart();
    }
}
