<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_dest;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $des_dest;

    /**
     * @ORM\OneToMany(targetEntity=Ville::class, mappedBy="dest_ville", orphanRemoval=true)
     */
    private $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeDest(): ?int
    {
        return $this->code_dest;
    }

    public function setCodeDest(int $code_dest): self
    {
        $this->code_dest = $code_dest;

        return $this;
    }

    public function getDesDest(): ?string
    {
        return $this->des_dest;
    }

    public function setDesDest(string $des_dest): self
    {
        $this->des_dest = $des_dest;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setDestVille($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->contains($ville)) {
            $this->villes->removeElement($ville);
            // set the owning side to null (unless already changed)
            if ($ville->getDestVille() === $this) {
                $ville->setDestVille(null);
            }
        }

        return $this;
    }
}
