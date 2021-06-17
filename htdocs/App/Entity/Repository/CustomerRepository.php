<?php

namespace App\Entity\Repository;


use App\Entity\Customer;
use App\Entity\EntityInterface;
use PDO;

class CustomerRepository extends AbstractRepository
{

    public function findAll(): array
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM customers");
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($customers as $customer) {
            $res[] = new Customer($customer["id"], $customer["firstname"], $customer["lastname"]);
        }
        return $res;
    }

    public function find(int $id): EntityInterface
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM customers WHERE id <= :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Customer($customer["id"], $customer["firstname"], $customer["lastname"]);

    }

    public function findBy($column, $value): array
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM customers WHERE `" . $column . "` = :val");
        $stmt->bindValue(":val", $value);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($customers as $customer) {
            $res[] = new Customer($customer["id"], $customer["firstname"], $customer["lastname"]);
        }
        return $res;
    }
}