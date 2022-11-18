<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 50; $i++) { 
            for ($j=1; $j <= 5; $j++) { 
                for ($k = 1; $k <= 22; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence(rand(1,6)));
                    $episode->setNumber($k);
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $episode->setSeason($this->getReference('program_' . $i . '_season_number_' . $j));
                    $manager->persist($episode);
                }
            }
        }
        
        $manager->flush();
    }
    public function getDependencies()
    {
        return  [
            SeasonFixtures::class
        ];
    }
}
