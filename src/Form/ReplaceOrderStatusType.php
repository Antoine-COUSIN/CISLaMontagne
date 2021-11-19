<?php

namespace App\Form;

use App\Entity\OrderRequired;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReplaceOrderStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('orderStatus', EntityType::class, [
            'label' => 'Status de la commande :',
            'class' => OrderStatus::class,
            'choice_label' => 'statusName',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderRequired::class,
        ]);
    }
}
