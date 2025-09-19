<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EquipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $equipe = new Equipe();
        $equipe->setNom('Equipe 1');
        $equipe->setLienPrototype('https://google.com');

        $manager->persist($equipe);
        $manager->flush();
    }
}
