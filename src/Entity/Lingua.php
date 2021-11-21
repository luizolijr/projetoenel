<?php

namespace App\Entity;

use App\Repository\LinguaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinguaRepository::class)
 */
class Lingua
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidato::class, inversedBy="linguas")
     */
    private $candidato;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nivel_fluencia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidato(): ?Candidato
    {
        return $this->candidato;
    }

    public function setCandidato(?Candidato $candidato): self
    {
        $this->candidato = $candidato;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getNivelFluencia(): ?string
    {
        return $this->nivel_fluencia;
    }

    public function setNivelFluencia(?string $nivel_fluencia): self
    {
        $this->nivel_fluencia = $nivel_fluencia;

        return $this;
    }
}
