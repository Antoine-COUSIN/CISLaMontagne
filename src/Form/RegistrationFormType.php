<?php

namespace App\Form;

use App\Entity\Fonction;
use App\Entity\User;
use App\Entity\Grade;
use App\Entity\Ranks;
use App\Entity\RoleCenter;
use App\Entity\Speciality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('phoneNumber')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répétez le mot de passe'],
                ))
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
