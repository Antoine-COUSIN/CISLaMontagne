<?php

namespace App\Form;

use App\Entity\ControlVehicles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControlVehiclesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oilLevel')
            ->add('refreshFluidLevel')
            ->add('washingFluidLevel')
            ->add('frontWireShape')
            ->add('backTireShape')
            ->add('bodyShape')
            ->add('indoorShape')
            ->add('frontWiper')
            ->add('backWiper')
            ->add('frontLighting')
            ->add('backLighting')
            ->add('annotation')
            ->add('dateControl')
            ->add('vehicles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ControlVehicles::class,
        ]);
    }
}
