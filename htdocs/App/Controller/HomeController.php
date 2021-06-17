<?php

namespace App\Controller;

use App\Entity\Repository\ProductRepository;

class HomeController extends AbstractController
{

    public function home()
    {
        return $this->render('home.phtml', []);
    }

}