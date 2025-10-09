<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Hackathon;
use App\Entity\Inscription;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $inscription = new Inscription();
        $inscription->setDate(new \DateTime());
        $inscription->setCompetence('Developpeur Web');
        $inscription->setEquipe($this->getReference('equipe1', Equipe::class));
        $inscription->setParticipant($this->getReference('participant1', Participant::class));
        $inscription->setHackathon($this->getReference('hackathon', Hackathon::class));


        $manager->persist($inscription);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Participant::class,Hackathon::class,Equipe::class];
    }
}
