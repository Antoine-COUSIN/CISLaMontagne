<?php

namespace App\Form;

use App\Entity\PharmaStock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmaReplenishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productsName', TextType::class, [
                'disabled' => true,
            ])
            ->add('productsQuantity', IntegerType::class, [
                'attr' => [
                    'autocomplete' => false,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PharmaStock::class,
        ]);
    }
}
