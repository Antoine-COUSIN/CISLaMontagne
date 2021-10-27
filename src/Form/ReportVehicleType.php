<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Vehicles;
use App\Entity\ReportVehicle;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportVehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reportVehicle', CKEditorType::class,[
                'label' => 'Description du problème',
            ])
            ->add('vehicles', EntityType::class, [
                'label' => 'Véhicule controlé :',
                'class' => Vehicles::class,
                'choice_label' => 'nameVehicle',
            ])
            ->add('user', EntityType::class, [
                'label' => 'S-P réalisant le signalement :',
                'class' => User::class,
                'choice_label' => function (User $user){
                    return $user->getfirstName() . ' ' . $user->getlastName();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReportVehicle::class,
        ]);
    }
}
