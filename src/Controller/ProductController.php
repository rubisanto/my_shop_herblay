<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/mes-produits', name: 'app_product')]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        // dd($products);
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/produit/{slug}', name: 'product')]
    public function detail($slug): Response
    {
        // Trouver le produit grace au slug
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        if (!$product) {
            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/detail.html.twig', [
            'product' => $product,
        ]);
    }
}
