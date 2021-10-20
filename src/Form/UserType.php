<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Grade;
use App\Entity\Ranks;
use App\Entity\Fonction;
use App\Entity\RoleCenter;
use App\Entity\Speciality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('firstName')
            ->add('lastName')
            ->add('phoneNumber')
            ->add('speciality', EntityType::class, [
                'class' => Speciality::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'nameSpeciality',
            ])
            ->add('roleCenter', EntityType::class, [
                'class' => RoleCenter::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'nameRoleCenter',
            ])
            ->add('rank', EntityType::class, [
                'class' => Ranks::class, 
                'choice_label' => 'nameRanks', 
                ])
            ->add('grade', EntityType::class, [
                'class' => Grade::class, 
                'choice_label' => 'nameGrade', 
                ])
            ->add('fonction', EntityType::class, [
                'class' => Fonction::class, 
                'choice_label' => 'nameFonction', 
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
