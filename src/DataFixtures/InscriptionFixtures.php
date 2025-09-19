<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $inscription = new Inscription();
        $inscription->setDate(new \DateTime());
        $inscription->setCompetence('Developpeur Web');

        $manager->persist($inscription);
        $manager->flush();
    }
}
