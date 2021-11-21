<?php

namespace App\Entity;

use App\Repository\CargoDesejadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CargoDesejadoRepository::class)
 */
class CargoDesejado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidato::class, inversedBy="cargos_desejados")
     */
    private $candidato;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pretencao_salarial;

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

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getPretencaoSalarial(): ?string
    {
        return $this->pretencao_salarial;
    }

    public function setPretencaoSalarial(?string $pretencao_salarial): self
    {
        $this->pretencao_salarial = $pretencao_salarial;

        return $this;
    }
}
