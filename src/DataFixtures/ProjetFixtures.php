<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $projet = new Projet();
        $projet->setDescription('Description projet');
        $projet->setRetenu('Retenu projet');

        $manager->persist($projet);
        $manager->flush();
    }
}
