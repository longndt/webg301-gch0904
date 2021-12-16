<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=15; $i++) {
            $book = new Book;
            $book->setTitle("Book $i");
            $book->setPrice(99.99);
            $book->setYear(rand(2010, 2021));
            $book->setCover("cover.jpg");
            $manager->persist($book);
        }

        $manager->flush();
    }
}
