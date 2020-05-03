<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'category';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($c = 0; $c < 10; $c++) {
            $category = new Category();
            $category->setTitle($faker->text(100));

            $this->setReference(self::CATEGORY_REFERENCE, $category);

            $manager->persist($category);
        }
        $manager->flush();
    }
}
