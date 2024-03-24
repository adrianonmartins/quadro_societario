<?php
namespace App\Entity;

use App\Repository\SociosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SociosRepository::class)]
class Socios
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private string $nome;

    #[ORM\Column(type: 'string')]
    private string $cpf;

    #[ORM\ManyToOne(targetEntity: Empresas::class, inversedBy: 'socios')]
    private Empresas $empresas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getEmpresas(): ?Empresas
    {
        return $this->empresas;
    }

    public function setEmpresas(?Empresas $empresas): self
    {
        $this->empresas = $empresas;
        return $this;
    }
}
