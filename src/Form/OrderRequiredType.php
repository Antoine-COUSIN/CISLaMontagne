<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\OrderStatus;
use App\Entity\OrderRequired;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OrderRequiredType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('userIdentity', TextType::class, [
                'label' => 'Demandeur :',
                'attr' => [
                    'readonly' => true,
                ],
                'data' => $options ['user_readonly_value'],
                'mapped' => false
            ])
            ->add('orderDescript', CKEditorType::class, [
                'label' => 'Description de la commande :'
            ])
            ->add('orderDate', DateType::class, [
                'label' => 'Date de la commande :',
                'format' => 'dd MMMM yyyy',
                'data' => new \DateTime("now")
            ])
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
            'user_readonly_value' => '',
        ]);
    }
}
