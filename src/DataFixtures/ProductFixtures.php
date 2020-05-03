<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($p = 0; $p < 20; $p++) {
            $product = new Product();
            $product->setTitle($faker->text(100));
            $product->setDescription('description '.$p.' '.$faker->text(150));
            $product->setPrice($faker->randomFloat(1, 200));
            $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE));

            $manager->persist($product);
        }
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
           CategoryFixtures::class
        ];
    }
}
