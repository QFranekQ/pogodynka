<?php

namespace App\Form;

use App\Entity\Forecast;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForecastType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('temperature', NumberType::class, [

                'html5' => true,
            ])
            ->add('cloudy', NumberType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'html5'=>true,
                ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('humidity', NumberType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                ],
                    'html5'=>true,
                ]
            )
            ->add('chanceOfPrecipitation', NumberType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'html5'=>true,
            ])
            ->add('location', EntityType::class, [
                'class' => 'App\Entity\Location',
                'choice_label' => 'city',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Forecast::class,
        ]);
    }
}
