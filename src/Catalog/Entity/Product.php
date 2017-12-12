<?php

namespace InboxAgency\Catalog\Entity;

class Product
{
    private $id;

    private $name;

    private $price;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function fromArray($array)
    {
        $this->setId($array['id']);
        $this->setName($array['name']);
        $this->setPrice($array['price']);
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice()
        ];
    }
}
