<?php

namespace App\Controller;

use App\Repository\PronosticRepository;
use App\Repository\UserRepository;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassementController extends AbstractController
{
    /**
     * @Route("/classement", name="classement")
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ["score" => "DESC"]);
        return $this->render('classement/index.html.twig', [
            'controller_name' => 'ClassementController',
            'users' => $users
        ]);
    }
}
