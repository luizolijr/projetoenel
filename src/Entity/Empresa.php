<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpresaRepository::class)
 */
class Empresa
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
    private $nome_fantasia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $razao_social;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cnpj;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefone1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefone2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logradouro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complemento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bairro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="empresa", cascade={"persist", "remove"})
     */
    private $usuario;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeFantasia(): ?string
    {
        return $this->nome_fantasia;
    }

    public function setNomeFantasia(string $nome_fantasia): self
    {
        $this->nome_fantasia = $nome_fantasia;

        return $this;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(?string $razao_social): self
    {
        $this->razao_social = $razao_social;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone1(): ?string
    {
        return $this->telefone1;
    }

    public function setTelefone1(?string $telefone1): self
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    public function getTelefone2(): ?string
    {
        return $this->telefone2;
    }

    public function setTelefone2(?string $telefone2): self
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    public function setLogradouro(?string $logradouro): self
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

}
