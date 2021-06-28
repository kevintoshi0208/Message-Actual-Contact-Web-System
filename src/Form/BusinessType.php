<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Bussiness;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BusinessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('wgs84E',NumberType::class,[
                'scale' => 5,
                'grouping' => true
            ])
            ->add('wgs84N',NumberType::class,[
                'scale' => 5,
                'grouping' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bussiness::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
}