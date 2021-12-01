<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class,
                [
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 20
                    ]
                ])
            ->add('Age', IntegerType::class,
                [
                    'attr' => [
                        'min' => 18,
                        'max' => 60
                    ]
                ])
            ->add('Birthday', DateType::class,
                [
                    'widget' => 'single_text'
                ])
            ->add('Gender', ChoiceType::class,
                [
                    'choices' => [
                        'Male' =>  'Male',
                        'Female' => 'Female'
                    ],
                    'expanded' => true
                ])
            /*
              ChoiceType: mặc định sẽ hiển thị theo kiểu drop-down list
              Muốn hiển thị kiểu Radio button: 'expanded' => true
              Muốn hiển thị kiểu Checkbox: 'expanded' => true, 'multiple' => true
            */
            ->add('Add', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
