<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lienPortefolio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLienPortefolio(): ?string
    {
        return $this->lienPortefolio;
    }

    public function setLienPortefolio(string $lienPortefolio): static
    {
        $this->lienPortefolio = $lienPortefolio;

        return $this;
    }
}
