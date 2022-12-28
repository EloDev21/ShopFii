<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $em; 
    public function __construct(EntityManagerInterface $emi)
    {
        $this->em = $emi;
    }

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        $search = new Search();
        $form = $this->createForm(SearchType::class,$search);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $products = $this->em->getRepository(Product::class)->findSearch($search);
        }
        
        
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function showslug($slug): Response
    {
        $product = $this->em->getRepository(Product::class)->findOneBySlug($slug);
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('product/detail.html.twig', [
            'product' => $product
        ]);
    }
}