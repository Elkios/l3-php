<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    CONST PAGE_NAME = "Accueil";

    public function home()
    {
        $this->render('home.phtml', []);
    }

}