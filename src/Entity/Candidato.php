<?php

namespace App\Entity;

use App\Repository\CandidatoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatoRepository::class)
 */
class Candidato
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $primeiro_emprego;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data_nascimento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_filhos;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $possui_decifiencia;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $carteira_habilitacao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nacionalidade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $naturalidade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefone1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $falarcom1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefone2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $falarcom2;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="candidato", cascade={"persist", "remove"})
     */
    private $usuario;

    

    /**
     * @ORM\OneToMany(targetEntity=Experiencia::class, mappedBy="candidato")
     */
    private $experiencias;

    /**
     * @ORM\OneToMany(targetEntity=Formacao::class, mappedBy="candidato")
     */
    private $formacaos;

    /**
     * @ORM\OneToMany(targetEntity=Lingua::class, mappedBy="candidato")
     */
    private $linguas;

    /**
     * @ORM\OneToMany(targetEntity=Software::class, mappedBy="candidato")
     */
    private $softwares;

    /**
     * @ORM\OneToMany(targetEntity=CargoDesejado::class, mappedBy="candidato")
     */
    private $cargos_desejados;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $senha;

    public function __construct()
    {
        $this->experiencias = new ArrayCollection();
        $this->formacaos = new ArrayCollection();
        $this->linguas = new ArrayCollection();
        $this->softwares = new ArrayCollection();
        $this->cargos_desejados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getPrimeiroEmprego(): ?bool
    {
        return $this->primeiro_emprego;
    }

    public function setPrimeiroEmprego(?bool $primeiro_emprego): self
    {
        $this->primeiro_emprego = $primeiro_emprego;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(?\DateTimeInterface $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estado_civil;
    }

    public function setEstadoCivil(?string $estado_civil): self
    {
        $this->estado_civil = $estado_civil;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getNumeroFilhos(): ?string
    {
        return $this->numero_filhos;
    }

    public function setNumeroFilhos(?string $numero_filhos): self
    {
        $this->numero_filhos = $numero_filhos;

        return $this;
    }

    public function getPossuiDecifiencia(): ?bool
    {
        return $this->possui_decifiencia;
    }

    public function setPossuiDecifiencia(?bool $possui_decifiencia): self
    {
        $this->possui_decifiencia = $possui_decifiencia;

        return $this;
    }

    public function getCarteiraHabilitacao(): ?bool
    {
        return $this->carteira_habilitacao;
    }

    public function setCarteiraHabilitacao(?bool $carteira_habilitacao): self
    {
        $this->carteira_habilitacao = $carteira_habilitacao;

        return $this;
    }

    public function getNacionalidade(): ?string
    {
        return $this->nacionalidade;
    }

    public function setNacionalidade(?string $nacionalidade): self
    {
        $this->nacionalidade = $nacionalidade;

        return $this;
    }

    public function getNaturalidade(): ?string
    {
        return $this->naturalidade;
    }

    public function setNaturalidade(?string $naturalidade): self
    {
        $this->naturalidade = $naturalidade;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

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

    public function getTelefone1(): ?string
    {
        return $this->telefone1;
    }

    public function setTelefone1(?string $telefone1): self
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    public function getFalarcom1(): ?string
    {
        return $this->falarcom1;
    }

    public function setFalarcom1(?string $falarcom1): self
    {
        $this->falarcom1 = $falarcom1;

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

    public function getFalarcom2(): ?string
    {
        return $this->falarcom2;
    }

    public function setFalarcom2(?string $falarcom2): self
    {
        $this->falarcom2 = $falarcom2;

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

    

    /**
     * @return Collection|Experiencia[]
     */
    public function getExperiencias(): Collection
    {
        return $this->experiencias;
    }

    public function addExperiencia(Experiencia $experiencia): self
    {
        if (!$this->experiencias->contains($experiencia)) {
            $this->experiencias[] = $experiencia;
            $experiencia->setCandidato($this);
        }

        return $this;
    }

    public function removeExperiencia(Experiencia $experiencia): self
    {
        if ($this->experiencias->removeElement($experiencia)) {
            // set the owning side to null (unless already changed)
            if ($experiencia->getCandidato() === $this) {
                $experiencia->setCandidato(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formacaos[]
     */
    public function getFormacaos(): Collection
    {
        return $this->formacaos;
    }

    public function addFormacao(Formacao $formacao): self
    {
        if (!$this->formacaos->contains($formacao)) {
            $this->formacaos[] = $formacao;
            $formacao->setCandidato($this);
        }

        return $this;
    }

    public function removeFormacao(Formacao $formacao): self
    {
        if ($this->formacaos->removeElement($formacao)) {
            // set the owning side to null (unless already changed)
            if ($formacao->getCandidato() === $this) {
                $formacao->setCandidato(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lingua[]
     */
    public function getLinguas(): Collection
    {
        return $this->linguas;
    }

    public function addLingua(Lingua $lingua): self
    {
        if (!$this->linguas->contains($lingua)) {
            $this->linguas[] = $lingua;
            $lingua->setCandidato($this);
        }

        return $this;
    }

    public function removeLingua(Lingua $lingua): self
    {
        if ($this->linguas->removeElement($lingua)) {
            // set the owning side to null (unless already changed)
            if ($lingua->getCandidato() === $this) {
                $lingua->setCandidato(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Software[]
     */
    public function getSoftwares(): Collection
    {
        return $this->softwares;
    }

    public function addSoftware(Software $software): self
    {
        if (!$this->softwares->contains($software)) {
            $this->softwares[] = $software;
            $software->setCandidato($this);
        }

        return $this;
    }

    public function removeSoftware(Software $software): self
    {
        if ($this->softwares->removeElement($software)) {
            // set the owning side to null (unless already changed)
            if ($software->getCandidato() === $this) {
                $software->setCandidato(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CargoDesejado[]
     */
    public function getCargosDesejados(): Collection
    {
        return $this->cargos_desejados;
    }

    public function addCargosDesejado(CargoDesejado $cargosDesejado): self
    {
        if (!$this->cargos_desejados->contains($cargosDesejado)) {
            $this->cargos_desejados[] = $cargosDesejado;
            $cargosDesejado->setCandidato($this);
        }

        return $this;
    }

    public function removeCargosDesejado(CargoDesejado $cargosDesejado): self
    {
        if ($this->cargos_desejados->removeElement($cargosDesejado)) {
            // set the owning side to null (unless already changed)
            if ($cargosDesejado->getCandidato() === $this) {
                $cargosDesejado->setCandidato(null);
            }
        }

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }
}
