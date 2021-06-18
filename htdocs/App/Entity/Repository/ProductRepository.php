<?php

namespace App\Entity\Repository;


use App\Entity\Product;

class ProductRepository extends AbstractRepository
{

    const TABLE_NAME = "products";
    const CLASS_NAME = Product::class;

}