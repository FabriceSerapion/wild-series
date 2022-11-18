<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 50; $i++) { 
            for ($j=1; $j <= 5; $j++) { 
                $season = new Season();
                $season->setNumber($j);
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($this->getReference('program_'.$i));
                $season->setYear(($season->getProgram()->getYear()) + $j);
                $manager->persist($season);
                $this->addReference('program_' . $i . '_season_number_' . $j, $season);
            }
            
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
