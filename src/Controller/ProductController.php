<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    // Utiliser l'entity manager  
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/mes-produits', name: 'app_product')]
    public function index(): Response
    {
        // chercher le manager 

        // utiliser dessus la methode getRepository
        //utiliser dessus la méthode findAll() 

        $product = $this->entityManager->getRepository(Product::class)->findAll();


        return $this->render('product/index.html.twig');
    }
}
