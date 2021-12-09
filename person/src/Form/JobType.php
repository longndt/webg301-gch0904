<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'JobName',
                TextType::class,
                [
                    'label' => 'Job Name',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 20
                    ]
                ]
            )
            ->add(
                'JobCompany',
                TextType::class,
                [
                    'label' => 'Job Company',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 20
                    ]
                ]
            )
            ->add(
                'Salary',
                MoneyType::class,
                [
                    'label' => 'Job Salary',
                    'required' => true,
                    'currency' => 'USD',
                    'attr' => [
                        'min' => 100,
                        'max' => 10000
                    ]
                ]
            )
            ->add(
                'Person',
                EntityType::class,
                [
                    'label' => 'Employee Name',
                    'class' => Person::class,
                    'choice_label' => 'PersonName',
                    'multiple' => true,
                    'expanded' => true
                ]
            )
            ->add('Save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
