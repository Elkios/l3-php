<?php


namespace App\Controller;


class CatalogController extends AbstractController
{

    public function view(){
        $list_product = [
            [
                "name" => "Short",
                "price" => 1000
            ],
            [
                "name" => "T-shirt",
                "price" => 1234567
            ],
        ];
        return $this->render("catalog/view.phtml", ['products' => $list_product]);
    }

    public function viewProduct(){
        $product = [
            "name" => "T-shirt",
            "description" => "T-shirt manches courtes blanc",
            "price" => 1234567,
        ];
        return $this->render("catalog/viewProduct.phtml", ["product" => $product]);
    }

}