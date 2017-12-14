<?php

namespace InboxAgency\Catalog\Repository;

interface ProductRepositoryInterface
{
    public function findById($id);

    public function getList();
}
