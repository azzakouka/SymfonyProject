<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 */
class Circuit
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
    private $code_circuit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $des_circuit;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree_circuit;

    /**
     * @ORM\OneToMany(targetEntity=Etape::class, mappedBy="circuit_etape", orphanRemoval=true)
     */
    private $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCircuit(): ?int
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(int $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function getDesCircuit(): ?string
    {
        return $this->des_circuit;
    }

    public function setDesCircuit(string $des_circuit): self
    {
        $this->des_circuit = $des_circuit;

        return $this;
    }

    public function getDureeCircuit(): ?int
    {
        return $this->duree_circuit;
    }

    public function setDureeCircuit(int $duree_circuit): self
    {
        $this->duree_circuit = $duree_circuit;

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setCircuitEtape($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->contains($etape)) {
            $this->etapes->removeElement($etape);
            // set the owning side to null (unless already changed)
            if ($etape->getCircuitEtape() === $this) {
                $etape->setCircuitEtape(null);
            }
        }

        return $this;
    }
}
