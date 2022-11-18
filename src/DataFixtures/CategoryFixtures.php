<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Horreur',
        'Fantastique',
        'Drame',
        'Comédie',
        'Thriller'
    ];
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName(self::CATEGORIES[$i]);
            $manager->persist($category);
            $this->addReference('category_'.self::CATEGORIES[$i], $category);
        }
        $manager->flush();
    }
}
