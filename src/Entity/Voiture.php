<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date_Mise_en_marche = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Modele = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Prix_jour = null;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Location::class)]
    private Collection $location;

    public function __construct()
    {
        $this->location = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(?string $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDateMiseEnMarche(): ?\DateTimeInterface
    {
        return $this->Date_Mise_en_marche;
    }

    public function setDateMiseEnMarche(?\DateTimeInterface $Date_Mise_en_marche): static
    {
        $this->Date_Mise_en_marche = $Date_Mise_en_marche;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(?string $Modele): static
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getPrixJour(): ?string
    {
        return $this->Prix_jour;
    }

    public function setPrixJour(?string $Prix_jour): static
    {
        $this->Prix_jour = $Prix_jour;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocation(): Collection
    {
        return $this->location;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->location->contains($location)) {
            $this->location->add($location);
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->location->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }
}
