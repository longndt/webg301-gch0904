<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Person;
use App\Entity\PersonDetail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'PersonName',
                TextType::class,
                [
                    'label' => 'Person Name',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 20
                    ]
                ]
            )
            ->add(
                'PersonAge',
                IntegerType::class,
                [
                    'label' => 'Person Age',
                    'required' => true,
                    'attr' => [
                        'min' => 18,
                        'max' => 60
                    ]
                ]
            )
            ->add(
                'personDetail',
                PersonDetailType::class
            )
            ->add('Save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
