<?php

namespace App\DataFixtures;

use App\Entity\Noter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NoterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $noter = new Noter();
            $noter->setNote(10);
            $manager->persist($noter);
            $manager->flush();
        }
    }
}
