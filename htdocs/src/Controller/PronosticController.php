<?php

namespace App\Controller;

use App\Entity\Pronostic;
use App\Repository\UserRepository;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class PronosticController extends AbstractController
{
    /**
     * @Route("/pronostic", name="pronostic")
     * @throws GuzzleException
     */
    public function index(): Response
    {

        $client = new Client();
        $res = $client->request('GET', 'http://mathys-pomier.fr:4000/euro');
        return $this->render('pronostic/index.html.twig', [
            'controller_name' => 'PronosticController',
            'matchs' => json_decode($res->getBody()->getContents(), true)
        ]);
    }

    /**
     * @Route("/pronostic/add", name="pronosticAdd", methods={"POST"})
     */
    public function addProno(Request $request, UserRepository $userRepository): Response
    {
        $domicileBet = $request->get("domicile_bet");
        $exterieurBet = $request->get("exterieur_bet");
        $matchId = $request->get("match_id");
        $userId = $this->getUser()->getId();

        $pronosticManager = $this->getDoctrine()->getManager();
        $pronostic = new Pronostic();
        $pronostic->setUserid($userId);
        $pronostic->setMatchid($matchId);
        $pronostic->setDomicileBet($domicileBet);
        $pronostic->setExterieurBet($exterieurBet);
        $pronostic->setScoreBet(-1);
        $pronosticManager->persist($pronostic);
        $pronosticManager->flush();

        return $this->redirect("/compte");
    }

}
