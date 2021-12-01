<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=20; $i++) {
            $blog = new Blog();
            $blog->setTitle("Blog " . $i);
            $blog->setContent("This is blog content");
            $blog->setAuthor("Author " . rand(1,10));
            $blog->setDate(\DateTime::createFromFormat('Y-m-d', '2021-03-05'));
            $manager->persist($blog);
        }
        $manager->flush();
    }
}
