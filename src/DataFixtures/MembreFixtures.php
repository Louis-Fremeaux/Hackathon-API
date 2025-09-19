<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $membre = new Membre();
        $membre->setNom('FREMEAUX');
        $membre->setPrenom('Louis');
        $membre->setEmail("louis.fremeaux@icloud.com");
        $membre->setTelephone("+33 9 33 9 33 9");

        $manager->persist($membre);
        $manager->flush();
    }
}
