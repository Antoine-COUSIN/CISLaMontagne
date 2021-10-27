<?php

namespace App\Form;

use App\Entity\ControlVehicles;
use App\Entity\Vehicles;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControlVehiclesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oilLevel', ChoiceType::class,[
                'label' => 'Niveau d\'huile :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('refreshFluidLevel', ChoiceType::class,[
                'label' => 'Niveau refroidissement :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('washingFluidLevel', ChoiceType::class,[
                'label' => 'Niveau lave glace :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('frontWireShape', ChoiceType::class,[
                'label' => 'Etat pneus AV :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('backTireShape', ChoiceType::class,[
                'label' => 'Etat pneus AR :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('bodyShape', ChoiceType::class,[
                'label' => 'Etat carrosserie :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('indoorShape', ChoiceType::class,[
                'label' => 'Etat intérieur :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('frontWiper', ChoiceType::class,[
                'label' => 'Etat essuies-glaces AV :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('backWiper', ChoiceType::class,[
                'label' => 'Etat essuie-glace AR :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('frontLighting', ChoiceType::class,[
                'label' => 'Etat éclairage AV :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('backLighting', ChoiceType::class,[
                'label' => 'Etat éclairage AR :',
                'choices' => [
                    'Bon' => 'Bon',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                ],
            ])
            ->add('annotation', CKEditorType::class, [
                'label' => 'Note :',
            ])
            ->add('dateControl', DateType::class,[
                'label' => 'Date du contrôle :',
            ])
            ->add('vehicles', EntityType::class, [
                'label' => 'Véhicule controlé :',
                'class' => Vehicles::class,
                'choice_label' => 'nameVehicle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ControlVehicles::class,
        ]);
    }
}
