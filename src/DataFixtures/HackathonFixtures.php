<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HackathonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $hackathon = new Hackathon();
        $hackathon->setDateHeureDebut(new \DateTime());
        $hackathon->setDateHeureFin(new \DateTime());
        $hackathon->setLieu("préambule");
        $hackathon->setVille("ligné");
        $hackathon->setTheme("Cyber");

        $manager->persist($hackathon);
        $manager->flush();
    }
}
