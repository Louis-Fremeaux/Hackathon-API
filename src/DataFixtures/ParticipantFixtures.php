<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParticipantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $participant = new Participant();
        $participant->setDateNaissance(new \DateTime());
        $participant->setLienPortefolio('http://louis-fremeaux.tech');

        $manager->persist($participant);
        $manager->flush();
    }
}
