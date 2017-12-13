<?php

namespace InboxAgency\Cart\Service;

use InboxAgency\Session\SessionInterface;
use InboxAgency\Cart\Entity\Cart;
use InboxAgency\Cart\Entity\CartItem;
Use InboxAgency\Catalog\Entity\ProductInterface;

class CartService
{
    private $session;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getCart()
    {
        $cart = $this->session->get('cart');

        if ($cart == null) {
            $cart = new Cart();
        }

        return $cart;
    }

    public function addProduct(ProductInterface $product, $qty = 1)
    {
        $cart = $this->getCart();

        $cart->addCartItem(new CartItem($product, $qty));
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
