<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /**
     * @Route("/catalog", name="catalog")
     */
    public function index(ProductRepository $productRepository): Response
    {

        $products = $productRepository->findAll();

        $product = new Product();
        $product->setName('Logitech G Pro Mouse');
        $product->setPrice(200);

        $form = $this->createFormBuilder($product)
            ->setAction($this->generateUrl('catalogInsertProduct'))
            ->setMethod('POST')
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('Add', SubmitType::class, ['label' => 'Add product'])
            ->getForm();


        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/catalog/insert", name="catalogInsertProduct", methods={"POST"})
     */
    public function addProductRoute(Request $request): Response
    {

        $name = $request->request->get("form")["name"];
        $price = $request->request->get("form")["price"];


        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('catalog');
    }

    /**
     * @Route("/catalog/product", name="product")
     */
    public function product(ProductRepository $productRepository): Response
    {

        $product = $productRepository->find(1);

        return $this->render('product/product.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product
        ]);
    }
}
