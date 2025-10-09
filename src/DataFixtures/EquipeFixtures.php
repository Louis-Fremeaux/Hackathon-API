<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Inscription;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;

class EquipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $equipe = new Equipe();
        $equipe->setNom('Equipe 1');
        $equipe->setLienPrototype('https://google.com');
        $equipe->setProjet($this->getReference('projet', Projet::class));
        $equipe->setBeResponsable($this->getReference('inscription1', Inscription::class));

        $this->addReference('equipe1', $equipe);

        $manager->persist($equipe);
        $manager->flush();
    }


}
