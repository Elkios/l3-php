<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customers", name="customer")
     */
    public function index(CustomerRepository $customerRepository): Response
    {

        $customers = $customerRepository->findAll();


        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
            'customers' => $customers
        ]);
    }
}
