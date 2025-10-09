<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use App\Entity\Organisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HackathonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $hackathon = new Hackathon();
        $hackathon->setDateHeureDebut(new \DateTime());
        $hackathon->setDateHeureFin(new \DateTime());
        $hackathon->setLieu("préambule");
        $hackathon->setVille("ligné");
        $hackathon->setTheme("Cyber");
        $hackathon->setOrganisateur($this->getReference('organisateur1', Organisateur::class));

        $this->addReference('hackathon', $hackathon);

        $manager->persist($hackathon);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [OrganisateurFixtures::class];
    }
}
