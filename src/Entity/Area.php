<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=AreaRepository::class)
 */
class Area
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
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity=Cargo::class, mappedBy="area")
     */
    private $cargos;

    public function __construct()
    {
        $this->cargos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection|Cargo[]
     */
    public function getCargos(): Collection
    {
        return $this->cargos;
    }

    public function addCargo(Cargo $cargo): self
    {
        if (!$this->cargos->contains($cargo)) {
            $this->cargos[] = $cargo;
            $cargo->setArea($this);
        }

        return $this;
    }

    public function removeCargo(Cargo $cargo): self
    {
        if ($this->cargos->removeElement($cargo)) {
            // set the owning side to null (unless already changed)
            if ($cargo->getArea() === $this) {
                $cargo->setArea(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getDescricao();
    }
}
