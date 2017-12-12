<?php

namespace InboxAgency\Catalog\Repository;

use Doctrine\DBAL\Connection;
use InboxAgency\Catalog\Entity\Product;

class DBALProductRepository implements ProductRepository
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function getList()
    {
        $sql = 'SELECT * FROM products';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        $products = [];

        foreach($data as $row) {
            $product = new Product();
            $product->fromArray($row);

            $products[] = $product;
        }

        return $products;
    }
}
