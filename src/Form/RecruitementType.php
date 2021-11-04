<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RecruitementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre Prénom :',
                'attr' => [
                    'class' => 'contact-form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom :',
                'attr' => [
                    'class' => 'contact-form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre E-mail',
                'attr' =>[
                    'class' => 'contact-form-control'
                ]
            ])
            ->add('message', CKEditorType::class, [
                'label' => 'Votre motivation :'
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
