<?php

namespace InboxAgency\Cart\Service;

use InboxAgency\Session\SessionInterface;
use InboxAgency\Cart\Entity\Cart;
use InboxAgency\Cart\Entity\CartItem;
use InboxAgency\Catalog\Entity\ProductInterface;

class CartService implements CartServiceInterface
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

    public function removeProduct($productId)
    {
        $cart = $this->getCart();

        $cart->removeCartItem($productId);
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
