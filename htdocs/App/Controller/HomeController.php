<?php

namespace App\Controller;

use App\Entity\Repository\ProductRepository;

class HomeController extends AbstractController
{

    public function home()
    {
        $this->render('home.phtml', []);
    }

}