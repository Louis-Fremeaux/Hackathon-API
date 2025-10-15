<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HackathonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HackathonRepository::class)]
#[ApiResource]
class Hackathon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateHeureDebut = null;

    #[ORM\Column]
    private ?\DateTime $dateHeureFin = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $affiche = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objectifs = null;

    #[ORM\ManyToOne(inversedBy: 'hackathons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Organisateur $organisateur = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'hackathon')]
    private Collection $Projet;

    /**
     * @var Collection<int, MembreJury>
     */
    #[ORM\ManyToMany(targetEntity: MembreJury::class, inversedBy: 'hackathons')]
    private Collection $composer;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'hackathon')]
    private Collection $Inscription;

    public function __construct()
    {
        $this->Projet = new ArrayCollection();
        $this->composer = new ArrayCollection();
        $this->Inscription = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDebut(): ?\DateTime
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTime $dateHeureDebut): static
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTime
    {
        return $this->dateHeureFin;
    }

    public function setDateHeureFin(\DateTime $dateHeureFin): static
    {
        $this->dateHeureFin = $dateHeureFin;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): static
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getObjectifs(): ?string
    {
        return $this->objectifs;
    }

    public function setObjectifs(?string $objectifs): static
    {
        $this->objectifs = $objectifs;

        return $this;
    }

    public function getOrganisateur(): ?Organisateur
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Organisateur $organisateur): static
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjet(): Collection
    {
        return $this->Projet;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->Projet->contains($projet)) {
            $this->Projet->add($projet);
            $projet->setHackathon($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->Projet->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getHackathon() === $this) {
                $projet->setHackathon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MembreJury>
     */
    public function getComposer(): Collection
    {
        return $this->composer;
    }

    public function addComposer(MembreJury $composer): static
    {
        if (!$this->composer->contains($composer)) {
            $this->composer->add($composer);
        }

        return $this;
    }

    public function removeComposer(MembreJury $composer): static
    {
        $this->composer->removeElement($composer);

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscription(): Collection
    {
        return $this->Inscription;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->Inscription->contains($inscription)) {
            $this->Inscription->add($inscription);
            $inscription->setHackathon($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->Inscription->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getHackathon() === $this) {
                $inscription->setHackathon(null);
            }
        }

        return $this;
    }
}
