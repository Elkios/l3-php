<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    public function home()
    {
        return $this->render('home.phtml', []);
    }

}