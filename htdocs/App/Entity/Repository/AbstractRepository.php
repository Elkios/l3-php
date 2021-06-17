<?php

namespace App\Entity\Repository;

use Connexion;

abstract class AbstractRepository implements RepositoryInterface
{

    public function getConnexion() {
        return Connexion::getInstance()->getConnexion();
    }

}