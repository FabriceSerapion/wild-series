<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 50; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(rand(1, 6)));
            $program->setSynopsis($faker->paragraphs(2, true));
            $program->setYear(rand(1960, 2022));
            $program->setCountry([
                'France',
                'USA',
                'Allemagne',
                'Corée du Sud'
            ][rand(0, 3)]);
            $program->setCategory($this->getReference(
                'category_' . CategoryFixtures::CATEGORIES[rand(0, 4)]
            ));
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return  [
            CategoryFixtures::class,
        ];
    }
}
