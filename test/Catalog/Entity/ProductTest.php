<?php

namespace InboxAgency\Catalog\Entity;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $productData;

    public function setUp()
    {
        $this->productData = [
            'id' => 1,
            'name' => 'batata',
            'price' => 10.5
        ];
    }

    /**
     * @test
     */
    public function mustConvertProductToArray()
    {
        $product = new Product();
        $product->setId($this->productData['id']);
        $product->setName($this->productData['name']);
        $product->setPrice($this->productData['price']);

        $this->assertEquals($this->productData, $product->toArray());
    }

    /**
     * @test
     */
    public function mustPopulateProductFromArray()
    {
        $product = new Product();
        $product->fromArray($this->productData);

        $this->assertEquals($this->productData['id'], $product->getId());
        $this->assertEquals($this->productData['name'], $product->getName());
        $this->assertEquals($this->productData['price'], $product->getPrice());
    }
}
