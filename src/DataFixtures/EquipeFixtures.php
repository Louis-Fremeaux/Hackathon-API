<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Inscription;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $equipe = new Equipe();
        $equipe->setNom('Equipe 1');
        $equipe->setLienPrototype('https://google.com');
        $equipe->setProjet($this->getReference('projet', Projet::class));
        $equipe->setBeResponsable(null);

        $this->addReference('equipe1', $equipe);

        $manager->persist($equipe);
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [ProjetFixtures::class];
    }
}
