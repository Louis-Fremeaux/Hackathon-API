<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $projet = new Projet();
        $projet->setDescription('Description projet');
        $projet->setRetenu('Retenu projet');
        $projet->setHackathon($this->getReference('hackathon', Hackathon::class));

        $this->addReference('projet', $projet);

        $manager->persist($projet);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [HackathonFixtures::class];
    }
}
