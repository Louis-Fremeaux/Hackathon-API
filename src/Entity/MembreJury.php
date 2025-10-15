<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MembreJuryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreJuryRepository::class)]
#[ApiResource]
class MembreJury
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Hackathon>
     */
    #[ORM\ManyToMany(targetEntity: Hackathon::class, mappedBy: 'composer')]
    private Collection $hackathons;

    public function __construct()
    {
        $this->hackathons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Hackathon>
     */
    public function getHackathons(): Collection
    {
        return $this->hackathons;
    }

    public function addHackathon(Hackathon $hackathon): static
    {
        if (!$this->hackathons->contains($hackathon)) {
            $this->hackathons->add($hackathon);
            $hackathon->addComposer($this);
        }

        return $this;
    }

    public function removeHackathon(Hackathon $hackathon): static
    {
        if ($this->hackathons->removeElement($hackathon)) {
            $hackathon->removeComposer($this);
        }

        return $this;
    }
}
