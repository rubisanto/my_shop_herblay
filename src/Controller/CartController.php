<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{



    // Modifier la route  
    #[Route('/cart', name: 'app_cart')]

    public function index(Cart $cart): Response
    {


        $cartController = $cart->getProducts($cart);

        // Le tableau permet de relier l'expression utilisé en twig et la variable 
        return $this->render('cart/index.html.twig',  [
            'cartController' => $cartController,
        ]);
    }

    // Transfert de l'id entre la route et la variable $id avec la méthode path() dans la vue
    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(Cart $cart, $id): Response
    {

        $cart->add($id);

        return $this->redirectToRoute('app_cart');
    }
}
