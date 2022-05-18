<?php

namespace App\Controller;

use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    //mettre l'entity manager 
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte/ajouter-adresse', name: 'app_address')]
    public function index(Request $request): Response
    {
        // Récupérer le user 
        $user = $this->getUser();

        //Create le form pour récupéer le form 
        $form = $this->createForm(AddressType::class, $user);

        //attraper le formulaire 
        $form->handleRequest($request);

        // Verifier si le formulaire a bien été soumis 
        if ($form->isSubmitted()   &&  $form->isValid()) {
        }






        return $this->render('address/index.html.twig', [
            'controller_name' => 'AddressController',
        ]);
    }
}
