<?php

namespace App\Entity;

use App\Repository\ExperienciaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienciaRepository::class)
 */
class Experiencia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidato::class, inversedBy="experiencias")
     */
    private $candidato;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ultimo_cargo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data_admissao;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data_demissao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ultimo_salario;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $atividade_exercida;

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

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function setEmpresa(?string $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getUltimoCargo(): ?string
    {
        return $this->ultimo_cargo;
    }

    public function setUltimoCargo(?string $ultimo_cargo): self
    {
        $this->ultimo_cargo = $ultimo_cargo;

        return $this;
    }

    public function getDataAdmissao(): ?\DateTimeInterface
    {
        return $this->data_admissao;
    }

    public function setDataAdmissao(?\DateTimeInterface $data_admissao): self
    {
        $this->data_admissao = $data_admissao;

        return $this;
    }

    public function getDataDemissao(): ?\DateTimeInterface
    {
        return $this->data_demissao;
    }

    public function setDataDemissao(?\DateTimeInterface $data_demissao): self
    {
        $this->data_demissao = $data_demissao;

        return $this;
    }

    public function getUltimoSalario(): ?string
    {
        return $this->ultimo_salario;
    }

    public function setUltimoSalario(?string $ultimo_salario): self
    {
        $this->ultimo_salario = $ultimo_salario;

        return $this;
    }

    public function getAtividadeExercida(): ?string
    {
        return $this->atividade_exercida;
    }

    public function setAtividadeExercida(?string $atividade_exercida): self
    {
        $this->atividade_exercida = $atividade_exercida;

        return $this;
    }
}
