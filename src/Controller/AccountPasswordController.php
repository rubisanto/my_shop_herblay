<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChangePasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/modifier-mot-de-passe', name: 'app_account_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        // mettre une variable null pour que dans certains cas twig n'affiche rien
        $notification = null;
        // Récupérer le User
        $user = $this->getUser();

        // Create form pour récupérer le form
        $form = $this->createForm(ChangePasswordType::class, $user);

        // attraper le formulaire  
        $form->handleRequest($request);

        // Vérifier si le formulaire a bien été soumis 
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer
            $old_pass = $form->get('old_password')->getData();
            // Vérifier si le mot de passe est identique que celui de la base de données
            if ($passwordHasher->isPasswordValid($user, $old_pass)) {
                $new_pass = $form->get('new_password')->getData();
                // dd($new_pass);
                // Crypter le nouveau mot de passe   
                $password = $passwordHasher->hashPassword($user, $new_pass);
                // modifier le mot de passe 
                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = "Le mot de passe a bien été mis à jour";
            } else {
                $notification = "Mot de passe actuel n'est pas le bon";
            }
        }

        // Pour la vue
        return $this->render('account/password.html.twig', [
            'form' => $form->CreateView(),
            'notification' => $notification
        ]);
    }
}
