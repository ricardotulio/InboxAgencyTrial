<?php

namespace InboxAgency\Catalog\Entity;

class Product implements \Serializable
{
    private $id;

    private $name;

    private $price;

    public function fromArray($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->price = $data['price'];
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice()
        ];
    }

    public function serialize()
    {
        return serialize($this->toArray());
    }

    public function unserialize($data)
    {
        $values = unserialize($data);
        $this->fromArray($values);
    }

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
}
