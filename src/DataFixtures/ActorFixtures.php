<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $actor = new Actor();
            $actor->setFirstname($faker->firstName($gender = null));
            $actor->setLastname($faker->lastName());
            $actor->addProgram($this->getReference('program_' . $i));
            $manager->persist($actor);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return  [
            ProgramFixtures::class
        ];
    }
}
