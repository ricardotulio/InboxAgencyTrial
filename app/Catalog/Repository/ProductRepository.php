<?php

namespace InboxAgency\Catalog\Repository;

interface ProductRepository
{
    public function findById($id);

    public function getList();
}
