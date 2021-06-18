<?php

namespace App\Entity\Repository;

use App\Entity\Customer;

class CustomerRepository extends AbstractRepository
{

    const TABLE_NAME = "customers";
    const CLASS_NAME = Customer::class;

}