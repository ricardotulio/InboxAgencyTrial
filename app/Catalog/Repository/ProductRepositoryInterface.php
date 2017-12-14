<?php

namespace InboxAgency\Catalog\Repository;

interface ProductRepositoryInterface
{
    public function findById($productId);

    public function getList();
}
