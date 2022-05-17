<?php

namespace App\Classe;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    // Ecapsulation 
    private $requestStack;


    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }


    public function add($id)
    {
        //Vérifier si le produit est déjà dans le panier 
        $cart =  $this->requestStack->getSession()->get('cart', []);
        if (empty($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }
        $this->requestStack->getSession()->set('cart', $cart);
    }

    public function get()
    {
        return $this->requestStack->getSession()->get('cart');
    }

    public function remove()
    {
        return  $this->requestStack->getSession()->remove('cart');
    }
    //Encapsulation 
    private $entityManager;



    public function getProducts()
    {

        $cartController = [];
        // mettre condition que le panier ne soit pas vide
        if (empty($this->get())) {

            return $cartController;
        } else {

            // Créer un tableau pour y stocker a chaque fois l index et la valeur 
            foreach ($this->get() as $key => $value) {
                # code...

                $products = $this->entityManager->getRepository(Product::class)->findOneById($key);
                $cartController[] = [
                    "products" => $products,
                    "quantity" => $value
                ];
            }
            return $cartController;
        }
    }

    public function removeProduct($id)
    {
        $cart =  $this->requestStack->getSession()->get('cart');
        // Supprimer seulement la ligne de produit correspondant à l'id 
        unset($cart[$id]);
        //renouveler avec le nouveau cart
        return $this->requestStack->getSession()->set('cart', $cart);
    }
}
