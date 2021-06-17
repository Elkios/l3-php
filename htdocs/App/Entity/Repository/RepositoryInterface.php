<?php

namespace App\Entity\Repository;

use App\Entity\EntityInterface;

interface RepositoryInterface
{
    /**
     * @return EntityInterface[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return EntityInterface
     */
    public function find(int $id): EntityInterface;

    /**
     * @param $column
     * @param $value
     * @return EntityInterface[]
     */
    public function findBy($column, $value): array;

}