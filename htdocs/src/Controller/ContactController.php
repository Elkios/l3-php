<?php

namespace App\Controller;

use App\Entity\Pronostic;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     * @Route("/contact/send", name="contactSend", methods={"GET", "POST"})
     */
    public function send(Request $request, UserRepository $userRepository): Response
    {
        $fullname = $request->get("fullanme");
        $email = $request->get("email");
        $message = $request->get("message");

        //if (!isset($fullname)) return $this->redirect("/contact");

        $to      = 'contact@project.com';
        $subject = 'Eurobet - Demande de ' . $fullname;
        $message = $message;
        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        return $this->render('contact/index.html.twig', [
            "info" => "Votre message a été envoyé !"
        ]);
    }
}
