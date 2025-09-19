<?php

namespace App\Entity;

use App\Repository\MembreJuryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreJuryRepository::class)]
class MembreJury
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
