<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', null,[
                'attr'=>[
                    'placeholder'=>'eg. Szczecin',
                ]
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Poland'=>'PL',
                    'Germany'=>'DE',
                    'France'=>'FR',
                    'Spain'=>'ES',
                    'Portugal'=>'PT',
                    'United States'=>'US',
                    'Italy'=>'IT',
                ]
            ])
            ->add('latitude', NumberType::class, [
                'scale' => 5,
                'html5' => true,
            ])
            ->add('longtitude', NumberType::class, [
                'scale' => 5,
                'html5' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
