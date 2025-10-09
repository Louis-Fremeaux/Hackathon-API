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
        $participant->setNom('FREMEAUX');
        $participant->setPrenom('Louis');
        $participant->setEmail("louis.fremeaux@icloud.com");
        $participant->setTelephone("+33 9 33 9 33 9");
        $participant->setDateNaissance(new \DateTime());
        $participant->setLienPortefolio('http://louis-fremeaux.tech');

        $this->addReference('participant1', $participant);

        $manager->persist($participant);
        $manager->flush();
    }
}
