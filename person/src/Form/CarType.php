<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'CarBrand',
                ChoiceType::class,
                [
                    'label' => 'Car Brand',
                    'required' => true,
                    'choices' => [
                        "Hyundai" => "Hyundai",
                        "Kia" => "Kia",
                        "Toyota" => "Toyota",
                        "Ford" => "Ford"
                    ],
                    'attr' => [
                        'maxlength' => 20,
                        'minlength' => 3
                    ]
                ]
            )
            ->add(
                'CarName',
                TextType::class,
                [
                    'label' => 'Car Name',
                    'required' => true,
                    'attr' => [
                        'maxlength' => 20,
                        'minlength' => 3
                    ]
                ]
            )
            ->add(
                'CarModel',
                IntegerType::class,
                [
                    'label' => 'Car Model',
                    'required' => true,
                    'attr' => [
                        'min' => 2000,
                        'max' => 2021
                    ]
                ]
            )
            ->add(
                'CarPrice',
                MoneyType::class,
                [
                    'label' => 'Car Price',
                    'required' => true,
                    'currency' => 'USD'
                ]
            )
            ->add(
                'CarColor',
                ChoiceType::class,
                [
                    'label' => 'Car Color',
                    'required' => true,
                    'choices' => [
                        "Black" => "Black",
                        "White" => "White",
                        "Blue" => "Blue",
                        "Red" => "Red"
                    ]
                ]
            )
            ->add(
                'CarPlate',
                TextType::class,
                [
                    'label' => 'Car Plate',
                    'required' => true,
                    'attr' => [
                        'minlength' => 8,
                        'maxlength' => 10
                    ]
                ]
            )
            ->add(
                'Person',
                EntityType::class,
                [
                    'label' => 'Car Owner',
                    'class' => Person::class,
                    'choice_label' => 'PersonName',
                    // 'multiple' => false,
                    // 'expanded' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
