<?php

namespace App\Entity\Repository;

use App\Entity\EntityInterface;
use App\Entity\Product;
use Connexion;
use PDO;

abstract class AbstractRepository implements RepositoryInterface
{
    
    protected $className;

    public function getConnexion() {
        return Connexion::getInstance()->getConnexion();
    }

    public function findAll(): array
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM " . static::TABLE_NAME);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::CLASS_NAME);
    }

    public function find(int $id): EntityInterface
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM ". static::TABLE_NAME . " WHERE " . (static::CLASS_NAME)::PRIMARY_KEY . " <= :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(static::CLASS_NAME);
    }

    public function findBy($column, $value): array
    {
        $stmt = $this->getConnexion()->prepare("SELECT * FROM ". static::TABLE_NAME . " WHERE `" . $column . "` = :val");
        $stmt->bindValue(":val", $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::CLASS_NAME);
    }

}