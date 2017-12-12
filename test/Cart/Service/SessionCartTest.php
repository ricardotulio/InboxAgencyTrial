<?php

namespace InboxAgency\Cart\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Catalog\Entity\Product;

class SessionCartText extends TestCase
{
    private $sessionCart;

    public function setUp()
    {
        $this->sessionCart = new SessionCart();
    }

    /**
     * @test
     */
    public function mustVerifyIfHasProduct()
    {
        $product = new Product();
        $product->setId(1);
        $product->setName('Celular');
        $product->setPrice(10.2);

        $sessionCart = new SessionCart();
        $sessionCart->addProduct($product);

        $this->assertTrue($sessionCart->hasProduct());

        $sessionCart->removeProduct($product);

        $this->assertFalse($sessionCart->hasProduct());
    }

    /**
     * @test
     */
    public function mustAddProductToCart()
    {
        $product = new Product();
        $product->setId(1);
        $product->setName('Celular');
        $product->setPrice(10.2);

        $sessionCart = new SessionCart();
        $sessionCart->addProduct($product);

        $this->assertCount(1, $sessionCart->getProducts());
    }

    /**
     * @test
     */
    public function mustRemoveProductFromCart()
    {
        $product = new Product();
        $product->setId(1);
        $product->setName('Celular');
        $product->setPrice(10.2);

        $sessionCart = new SessionCart();
        $sessionCart->addProduct($product);

        $this->assertCount(1, $sessionCart->getProducts());

        $sessionCart->removeProduct($product);

        $this->assertCount(0, $sessionCart->getProducts());
    }

    /**
     * @test
     */
    public function mustReturnProductListFromCart()
    {
        $product1 = new Product();
        $product1->setId(1);
        $product1->setName('Celular');
        $product1->setPrice(10.2);

        $product2 = new Product();
        $product2->setId(2);
        $product2->setName('Notebook');
        $product2->setPrice(10.2);

        $product3 = new Product();
        $product3->setId(3);
        $product3->setName('Qualquer coisa');
        $product3->setPrice(10.2);

        $sessionCart = new SessionCart();
        $sessionCart->addProduct($product1);
        $sessionCart->addProduct($product2);
        $sessionCart->addProduct($product3);

        $this->assertCount(3, $sessionCart->getProducts());
    }

    /**
     * @test
     */
    public function mustCleanCart()
    {
        $product1 = new Product();
        $product1->setId(1);
        $product1->setName('Celular');
        $product1->setPrice(10.2);

        $product2 = new Product();
        $product2->setId(2);
        $product2->setName('Notebook');
        $product2->setPrice(10.2);

        $product3 = new Product();
        $product3->setId(3);
        $product3->setName('Qualquer coisa');
        $product3->setPrice(10.2);

        $sessionCart = new SessionCart();
        $sessionCart->addProduct($product1);
        $sessionCart->addProduct($product2);
        $sessionCart->addProduct($product3);

        $this->assertCount(3, $sessionCart->getProducts());

        $sessionCart->cleanCart();

        $this->assertCount(0, $sessionCart->getProducts());
    }

    /**
     * @test
     */
    public function mustCalculateTotalPriceFromCart()
    {
        $product1 = new Product();
        $product1->setId(1);
        $product1->setName('Celular');
        $product1->setPrice(10.2);

        $product2 = new Product();
        $product2->setId(2);
        $product2->setName('Notebook');
        $product2->setPrice(10.2);

        $product3 = new Product();
        $product3->setId(3);
        $product3->setName('Qualquer coisa');
        $product3->setPrice(10.2);

        $sessionCart = new SessionCart();
        $sessionCart->addProduct($product1);
        $sessionCart->addProduct($product2);
        $sessionCart->addProduct($product3);

        $expectedAmount = $product1->getPrice() + $product2->getPrice()
            + $product3->getPrice();

        $this->assertEquals(
            $expectedAmount,
            $sessionCart->getTotalPrice()
        );
    }
}
