<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\PersonDetail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'PersonAddress',
                TextType::class,
                [
                    'label' => 'Person Address',
                    'required' => true,
                    'attr' => [
                        'minlength' => 10,
                        'maxlength' => 50
                    ]
                ]
            )
            ->add(
                'PersonMobile',
                TextType::class,
                [
                    'label' => 'Person Mobile',
                    'required' => true,
                    'attr' => [
                        'minlength' => 10,
                        'maxlength' => 10
                    ]
                ]
            )
            ->add(
                'PersonBirthday',
                DateType::class,
                [
                    'label' => 'Person Birthday',
                    'required' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add('PersonCode', NumberType::class, [
                'label' => 'Person Number',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonDetail::class,
        ]);
    }
}
