<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('Avatar');
        $program->setSynopsis('L\'avatar doit retrouver ses pouvoirs pour sauver le monde');
        $program->setCategory($this->getReference('category_animation'));
        $manager->persist($program);
        $manager->flush();
        $program2 = new Program();
        $program2->setTitle('The haunting of hill house');
        $program2->setSynopsis('Un manoir hanté et des histoires de famille');
        $program2->setCategory($this->getReference('category_horreur'));
        $manager->persist($program2);
        $manager->flush();
        $program3 = new Program();
        $program3->setTitle('The boys');
        $program3->setSynopsis('Des gens sans pouvoirs combattent des super-héros qui sont en fait super méchants');
        $program3->setCategory($this->getReference('category_aventure'));
        $manager->persist($program3);
        $manager->flush();
        $program4 = new Program();
        $program4->setTitle('Game of thrones');
        $program4->setSynopsis('Des dragons, des trahisons et de l\'inceste');
        $program4->setCategory($this->getReference('category_fantastique'));
        $manager->persist($program4);
        $manager->flush();
        $program5 = new Program();
        $program5->setTitle('Peaky Blinders');
        $program5->setSynopsis('La bande des peaky blinders fait régner la terreur en angleterre');
        $program5->setCategory($this->getReference('category_action'));
        $manager->persist($program5);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
