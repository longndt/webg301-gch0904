<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $author = new Author;
            $author->setName("Author $i");
            $author->setGender("Male");
            $author->setAddress("Ha Noi");
            $author->setBirthday(\DateTime::createFromFormat('Y-m-d','1995-05-08'));
            $manager->persist($author);
        }

        $manager->flush();
    }
}
