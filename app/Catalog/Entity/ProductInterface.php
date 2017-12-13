<?php

namespace InboxAgency\Catalog\Entity;

interface ProductInterface
{
    public function fromArray($data);

    public function toArray();

    public function getId();

    public function getName();

    public function getPrice();
}
