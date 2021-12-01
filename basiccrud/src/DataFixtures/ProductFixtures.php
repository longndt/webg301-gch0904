<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=20; $i++) {
            $product = new Product();
            $product->setProductName("Product " . $i);
            $product->setProductQuantity(rand(50,100));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
