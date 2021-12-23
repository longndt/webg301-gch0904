<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,
            [
                'label' => 'Book Title',
                'required' => true,
                'attr' => 
                [
                    'minlength' => 5,
                    'maxlength' => 30
                ]
            ])
            ->add('cover', FileType::class, 
            [
                'label' => 'Book Cover',
                'data_class' => null,
                'required' => is_null($builder->getData()->getCover())
            ])
            ->add('price', MoneyType::class,
            [
                'label' => 'Book Price',
                'required' => true,
                'currency' => 'USD'
            ])
            ->add('year', IntegerType::class,         
            [
                'label' => 'Published Year',
                'required' => true,
                'attr' =>
                [
                    'min' => 2000,
                    'max' => 2021
                ]
            ])
            ->add('genre', EntityType::class,
            [
                'label' => 'Book Genre',
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('authors', EntityType::class,
            [
                'label' => 'Book Authors',
                'class' => Author::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
