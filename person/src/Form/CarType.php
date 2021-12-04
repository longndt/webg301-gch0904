<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CarName', TextType::class,
            [
                'label' => 'Car Name',
                'required' => true,
                'attr' => [
                    'maxlength' => 20,
                    'minlength' => 3
                ]
            ])
            ->add('CarBrand', TextType::class,
            [
                'label' => 'Car Brand',
                'required' => true,
                'attr' => [
                    'maxlength' => 20,
                    'minlength' => 3
                ]
            ])
            ->add('CarModel', IntegerType::class,
            [
                'label' => 'Car Model',
                'required' => true,
                'attr' => [
                    'min' => 2000,
                    'max' => 2021
                ]
            ])
            // ->add('Person')
            ->add('Add', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
