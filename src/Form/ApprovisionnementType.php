<?php

namespace App\Form;

use App\Entity\Approvisionnement;
use App\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // <--- VÉRIFIE QUE CETTE LIGNE EST LÀ
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprovisionnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => 'Référence commande',
                'required' => true,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: APP-2023-001']
            ])
            ->add('date', DateType::class, [
                'label' => 'Date d\'approvisionnement',
                'widget' => 'single_text',
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'nom',
                'label' => 'Sélectionner le fournisseur',
                'placeholder' => 'Choisir un fournisseur...',
                'attr' => ['class' => 'form-select']
            ])
            
            // --- C'EST CE BLOC QUI TE MANQUE SUREMENT ---
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut de la commande',
                'choices'  => [
                    'En attente' => 'En attente',
                    'Reçu' => 'Reçu',
                    'Annulé' => 'Annulé',
                ],
                'attr' => ['class' => 'form-select']
            ])
            // ---------------------------------------------
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Approvisionnement::class,
        ]);
    }
}