<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'votre nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'votre prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'votre nom de famille'
            ])
            ->add('company', TextType::class, [
                'label' => 'votre entreprise'
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse'
            ])
            ->add('postal', TextType::class, [
                'label' => 'votre code postal'
            ])
            ->add('city', TextType::class, [
                'label' => 'votre ville'
            ])
            ->add('country', TextType::class, [
                'label' => 'votre pays'
            ])
            ->add('phone', TextType::class, [
                'label' => 'votre numéro de téléphone'
            ])
            ->add('user')
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer votre adresse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
