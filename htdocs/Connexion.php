<?php

class Connexion
{
    static private $instance;
    private $connexion;

    public function __construct()
    {
        $user = 'www-data';
        $pass = 'www-password';
        $this->connexion = new PDO('mysql:host=mysql;dbname=eurovent', $user, $pass);
    }

    static function getInstance() {
        if(!Connexion::$instance){
            Connexion::$instance = new Connexion();
        }
        return Connexion::$instance;
    }

    public function getConnexion()
    {
        return $this->connexion;
    }
}