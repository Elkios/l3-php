<?php


namespace App\Controller;


use App\Entity\Repository\CustomerRepository;

class CustomersController extends AbstractController
{

    public function view()
    {
        $customers = (new CustomerRepository())->findAll();
        return $this->render("customer/view.phtml", ['pageName' => 'Clients', 'customers' => $customers]);
    }

}