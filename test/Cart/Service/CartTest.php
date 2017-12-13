<?php

namespace InboxAgency\Cart\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\Session;

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
}
