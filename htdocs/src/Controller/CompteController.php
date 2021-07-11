<?php

namespace App\Controller;

use App\Entity\Pronostic;
use App\Entity\User;
use App\Repository\PronosticRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /* Récupération des pronos du joueur */
        $entityManager = $this->getDoctrine()->getManager();
        $pronostics = $entityManager->getRepository(Pronostic::class)->findBy(["userid" => $this->getUser()->getId()]);

        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());

        /* Récupération des matchs via API */
        $client = new Client();
        $matchs = json_decode($client->request('GET', 'http://mathys-pomier.fr:4000/euro')->getBody()->getContents(), true);

        /* Calcul des points */
        $pronosticsFinal = [];
        $scoreTotal = 0;
        foreach ($pronostics as $pronostic){
            if($pronostic->getScoreBet() < 0){
                if(isset($matchs[$pronostic->getMatchid()]["scores"])){
                    $winnerBet = $pronostic->getDomicileBet() >= $pronostic->getExterieurBet() ? "domicile" : "exterieur";
                    $otherTeam = $winnerBet == "exterieur" ? "domicile" : "exterieur";
                    $goodTeam = (
                        isset($matchs[$pronostic->getMatchid()]["scores"]["winner"]) && $matchs[$pronostic->getMatchid()]["scores"]["winner"] == $winnerBet
                        )
                        || (
                            $matchs[$pronostic->getMatchid()]["scores"][$winnerBet] >= $matchs[$pronostic->getMatchid()]["scores"][$otherTeam]
                        ) ;
                    $goodScore = ($pronostic->getDomicileBet() == $matchs[$pronostic->getMatchid()]["scores"]["domicile"] && $pronostic->getExterieurBet() == $matchs[$pronostic->getMatchid()]["scores"]["exterieur"]);
                    if($goodScore) {
                        $pronostic->setScoreBet(3);
                        $entityManager->flush();
                    }
                    else if($goodTeam) {
                        $pronostic->setScoreBet(1);
                        $entityManager->flush();
                    }
                    else {
                        $pronostic->setScoreBet(0);
                        $entityManager->flush();
                    }
                }
            }
            $scoreTotal += ($pronostic->getScoreBet() > 0 ? $pronostic->getScoreBet() : 0);
            $prono = [
                "domicileEquipe" => $matchs[$pronostic->getMatchid()]["teams"]["domicile"],
                "domicileBet" => $pronostic->getDomicileBet(),
                "exterieurEquipe" => $matchs[$pronostic->getMatchid()]["teams"]["exterieur"],
                "exterieurBet" => $pronostic->getExterieurBet()
            ];
            if(isset($matchs[$pronostic->getMatchid()]["scores"])){
                $prono["scoreDomicile"] = $matchs[$pronostic->getMatchid()]["scores"]["domicile"];
                $prono["scoreExterieur"] = $matchs[$pronostic->getMatchid()]["scores"]["exterieur"];
                $prono["tiraubut"] = isset($matchs[$pronostic->getMatchid()]["scores"]["tiraubut"]) ? $matchs[$pronostic->getMatchid()]["scores"]["tiraubut"] : false;
                $prono["winner"] = isset($matchs[$pronostic->getMatchid()]["scores"]["winner"]) ?
                    $matchs[$pronostic->getMatchid()]["scores"]["winner"] :
                    ($prono["scoreDomicile"] >= $prono["scoreExterieur"] ? "domicile" : "exterieur")
                ;
                $prono["score"] = $pronostic->getScoreBet();
            }
            $pronosticsFinal[] = $prono;
        }

        /* Update des points */
        $user->setScore($scoreTotal);
        $entityManager->flush();

        $users = $entityManager->getRepository(User::class)->findBy([], ["score" => "DESC"]);
        $rank = 0;

        foreach ($users as $rankUser){
            $rank++;
            if($rankUser->getUsername() == $user->getUsername()){
                break;
            }
        }

        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
            'pronostics' => $pronosticsFinal,
            'user' => $this->getUser(),
            'totalScore' => $scoreTotal,
            'rank' => $rank
        ]);
    }
}
