<?php

namespace App\Entity;

use App\Repository\FormacaoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormacaoRepository::class)
 */
class Formacao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidato::class, inversedBy="formacao")
     */
    private $candidato;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grau_formacao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $curso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instituicao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $situacao;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data_conclusao;

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

    public function getGrauFormacao(): ?string
    {
        return $this->grau_formacao;
    }

    public function setGrauFormacao(?string $grau_formacao): self
    {
        $this->grau_formacao = $grau_formacao;

        return $this;
    }

    public function getCurso(): ?string
    {
        return $this->curso;
    }

    public function setCurso(?string $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    public function getInstituicao(): ?string
    {
        return $this->instituicao;
    }

    public function setInstituicao(?string $instituicao): self
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(?string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }

    public function getDataConclusao(): ?\DateTimeInterface
    {
        return $this->data_conclusao;
    }

    public function setDataConclusao(?\DateTimeInterface $data_conclusao): self
    {
        $this->data_conclusao = $data_conclusao;

        return $this;
    }
}
