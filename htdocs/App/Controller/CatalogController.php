<?php


namespace App\Controller;


use App\Entity\Product;
use App\Entity\Repository\ProductRepository;

class CatalogController extends AbstractController
{

    public function view(){
        //$products =  (new ProductRepository())->findAll();
        $products = (new ProductRepository())->findBy("name", "Chemise");
        return $this->render("catalog/view.phtml", ['products' => $products]);
    }

    public function viewProduct(){
        $product = (new ProductRepository())->find(1);
        return $this->render("catalog/viewProduct.phtml", ["product" => $product]);
    }

}