<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $retenu = null;

    #[ORM\ManyToOne(inversedBy: 'Projet')]
    private ?Hackathon $hackathon = null;

    /**
     * @var Collection<int, Equipe>
     */
    #[ORM\OneToMany(targetEntity: Equipe::class, mappedBy: 'projet')]
    private Collection $travailler;

    public function __construct()
    {
        $this->travailler = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRetenu(): ?string
    {
        return $this->retenu;
    }

    public function setRetenu(string $retenu): static
    {
        $this->retenu = $retenu;

        return $this;
    }

    public function getHackathon(): ?Hackathon
    {
        return $this->hackathon;
    }

    public function setHackathon(?Hackathon $hackathon): static
    {
        $this->hackathon = $hackathon;

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getTravailler(): Collection
    {
        return $this->travailler;
    }

    public function addTravailler(Equipe $travailler): static
    {
        if (!$this->travailler->contains($travailler)) {
            $this->travailler->add($travailler);
            $travailler->setProjet($this);
        }

        return $this;
    }

    public function removeTravailler(Equipe $travailler): static
    {
        if ($this->travailler->removeElement($travailler)) {
            // set the owning side to null (unless already changed)
            if ($travailler->getProjet() === $this) {
                $travailler->setProjet(null);
            }
        }

        return $this;
    }
}
