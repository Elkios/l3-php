<?php

namespace App\Entity\Repository;


use App\Entity\EntityInterface;
use App\Entity\Product;
use PDO;

class ProductRepository extends AbstractRepository
{

    public function findAll(): array
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($products as $product){
            $res[] = new Product($product["id"], $product["name"], $product["price"]);
        }
        return $res;
    }

    public function find(int $id): EntityInterface
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM products WHERE id <= :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Product($product["id"], $product["name"], $product["price"]);

    }

    public function findBy($column, $value): array
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM products WHERE `" . $column . "` = :val");
        $stmt->bindValue(":val", $value);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($products as $product){
            $res[] = new Product($product["id"], $product["name"], $product["price"]);
        }
        return $res;
    }
}