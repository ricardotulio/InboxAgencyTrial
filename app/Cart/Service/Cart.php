<?php

namespace InboxAgency\Cart\Service;

use InboxAgency\Session\Session;
use InboxAgency\Cart\Entity\SimpleCart;
use InboxAgency\Cart\Entity\SimpleCartItem;

class Cart
{
    private $session;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getCart()
    {
        $cart = $this->session->get('cart');

        if ($cart == null) {
            $cart = new SimpleCart();
        }

        return $cart;
    }

    public function addProduct($product, $qty = 1)
    {
        $cart = $this->getCart();

        $cart->addCartItem(new SimpleCartItem($product, $qty));
        $this->session->set('cart', $cart);
    }

    public function removeProduct($id)
    {
        $cart = $this->getCart();

        $cart->removeCartItem($id);
        $this->session->set('cart', $cart);
    }

    public function hasItems()
    {
        return $this->getCart()->hasItems();
    }

    public function cleanCart()
    {
        $cart = $this->getCart();
        $cart->cleanCart();

        $this->session->set('cart', $cart);
    }
}
