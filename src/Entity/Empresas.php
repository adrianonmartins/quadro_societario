<?php
 namespace App\Entity;

use App\Repository\EmpresasRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

 #[ORM\Entity(repositoryClass: EmpresasRepository::class)]
 class Empresas 
 {

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
   
    private int|null $id;

    #[ORM\Column(type: 'string')]
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "O campo razão Social deve conter pelo menos {{ limit }} caracteres",
     *      maxMessage = "O campo razão Social não pode conter mais que {{ limit }} caracteres"
     * )
     */
    private string $razaosocial;

    #[ORM\Column(type: 'string')]
    private string $fantasia;

    #[ORM\Column(type: 'string')]
    private string $endereco;

    #[ORM\OneToMany(targetEntity: Socios::class, mappedBy: 'empresas')]
    private Collection $socios;

    public function __construct() {
      $this->socios = new ArrayCollection();
  }

    public function getSocios(): Collection
    {
        return $this->socios;
    }

    public function setSocios(Collection $socios): void
    {
        $this->socios = $socios;
    }
 
   public function getId(): int|null
   {
      return $this->id;
   }
   public function setId(int $id): void
   {
      $this->id =  $id;
   }

   public function getRazaosocial(): string
   {
      return $this->razaosocial;
   }
   public function setRazaosocial(string $razaosocial): void
   {
         $this->razaosocial = $razaosocial;    
   }

   public function getFantasia(): string
   {
      return $this->fantasia;
   }
   public function setFantasia(string $fantasia): void
   {
         $this->fantasia = $fantasia;     
   }
   
   public function getEndereco(): string
   {
      return $this->endereco;
   }
   public function setEndereco(string $endereco): void
   {
         $this->endereco = $endereco;
   }

}