<?php

namespace App\Form;

use App\Entity\Visiting;
use App\Validator\LegalVisitText;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Visiting $data */
        $data = $builder->getData();

        $builder
            ->add('visitTime',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => "yyyy-MM-dd'T'HH:mm:ss",
                'html5' => false
            ])
            ->add('phone')
            ->add('text',TextType::class,[
                'mapped' => false,
                'constraints' => new LegalVisitText()
            ])
        ;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiting::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }

}