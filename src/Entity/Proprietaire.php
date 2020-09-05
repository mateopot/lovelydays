<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProprietaireRepository::class)
 */
class Proprietaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $forename;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Propriete", mappedBy="proprietaire")
     */
    private $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getForename(): ?string
    {
        return $this->forename;
    }

    public function setForename(string $forename): self
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * @return Collection|propriete[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(propriete $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setProprietaire($this);
        }

        return $this;
    }

    public function removeProperty(propriete $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getProprietaire() === $this) {
                $property->setProprietaire(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
