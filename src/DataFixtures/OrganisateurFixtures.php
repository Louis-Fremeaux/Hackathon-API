<?php

namespace App\DataFixtures;

use App\Entity\Organisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $organisateur = new Organisateur();
        $organisateur->setStatut('actif');
        $organisateur->setNom('jhon');
        $organisateur->setSiteWeb('www.jhon.com');
        $organisateur->setEmail("jhon@gmail.com");

        $this->addReference('organisateur1', $organisateur);

        $manager->persist($organisateur);
        $manager->flush();
    }
}
