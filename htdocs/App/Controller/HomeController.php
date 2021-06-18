<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    public function home()
    {
        $this->render('home.phtml', []);
    }

}