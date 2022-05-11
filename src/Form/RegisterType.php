<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Ton prénom',
                'constraints' => new Length(['min' => 5, 'max' => 30]),
                'attr' => [
                    'placeholder' => 'Merci de saisir ton prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Ton nom',
                'constraints' => new Length(['min' => 5, 'max' => 30]),
                'attr' => [
                    'placeholder' => 'Merci de saisir ton nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Ton mail',
                'attr' => [
                    'placeholder' => 'Merci de saisir ton mail'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe n est pas identique',
                'label' => 'Ton mot de passe',
                'required' => true,
                'first_options' => ['label' => 'Ton mot de passe'],
                'second_options' => ['label' => 'Confirme ton mot de passe']
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
