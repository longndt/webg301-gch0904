<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Author name',
                'required' => true,
                'attr' =>
                [
                    'minlength' => 3
                ]
            ])
            ->add('birthday', DateType::class,
            [
                'label' => 'Author birthday',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('address', TextType::class,
            [
                'label' => 'Author address',
                'required' => true,
                'attr' => [
                    'minlength' => 5
                ]
            ])
            ->add('gender', ChoiceType::class,
            [
                'label' => 'Author gender',
                'required' => true,
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female'
                ]
            ])
            // ->add('books', EntityType::class,
            // [
            //     'label' => 'Published book(s)',
            //     'class' => Book::class,
            //     'choice_label' => 'title',
            //     'multiple' => true,
            //     'expanded' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
