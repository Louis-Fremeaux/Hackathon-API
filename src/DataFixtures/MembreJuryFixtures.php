<?php

namespace App\DataFixtures;

use App\Entity\MembreJury;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreJuryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $membreJury = new MembreJury();

        $manager->persist($membreJury);
        $manager->flush();
    }
}
