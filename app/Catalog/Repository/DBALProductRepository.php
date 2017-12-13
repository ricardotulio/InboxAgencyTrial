<?php

namespace InboxAgency\Catalog\Repository;

use Doctrine\DBAL\Connection;
use InboxAgency\Catalog\Entity\Product;

/**
 * @codeCoverageIgnore
 */
class DBALProductRepository implements ProductRepository
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function findById($id)
    {
        $sql = 'SELECT * FROM products where id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        $productData = $stmt->fetch();

        $product = false;
        
        if ($productData) {
            $product = new Product();
            $product->fromArray($productData);
        }

        return $product;
    }

    public function getList()
    {
        $sql = 'SELECT * FROM products';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        $products = [];

        foreach ($data as $row) {
            $product = new Product();
            $product->fromArray($row);

            $products[] = $product;
        }

        return $products;
    }
}
