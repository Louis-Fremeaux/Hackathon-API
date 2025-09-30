<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'participant')]
    private Collection $inscrire;

    public function __construct()
    {
        $this->inscrire = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscrire(): Collection
    {
        return $this->inscrire;
    }

    public function addInscrire(Inscription $inscrire): static
    {
        if (!$this->inscrire->contains($inscrire)) {
            $this->inscrire->add($inscrire);
            $inscrire->setParticipant($this);
        }

        return $this;
    }

    public function removeInscrire(Inscription $inscrire): static
    {
        if ($this->inscrire->removeElement($inscrire)) {
            // set the owning side to null (unless already changed)
            if ($inscrire->getParticipant() === $this) {
                $inscrire->setParticipant(null);
            }
        }

        return $this;
    }
}
