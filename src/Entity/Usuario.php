<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: "El campo 'Correo' no puede estar vacío.")]
    #[Assert\Email()]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length:500)]
    #[Assert\NotBlank(message: "El campo 'Contraseña' no puede estar vacío.")]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "El campo 'Nombre' no puede estar vacío.")]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "El campo 'Apellidos' no puede estar vacío.")]
    private ?string $Apellidos = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "El campo 'DNI' no puede estar vacío.")]
    private ?string $DNI = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "El campo 'Edad' no puede estar vacío.")]
    #[Assert\GreaterThanOrEqual(value: 18, message: 'Este valor debe ser mayor o igual a 18')]
    private ?int $Edad = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $Sexo = null;

    #[ORM\OneToMany(mappedBy: 'Usuario', targetEntity: Bono::class)]
    private Collection $bonos;

    public function __construct()
    {
        $this->bonos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_CLIENTE';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
         //$this->plainPassword = null;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): static
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): static
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->Edad;
    }

    public function setEdad(int $Edad): static
    {
        $this->Edad = $Edad;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->Sexo;
    }

    public function setSexo(?string $Sexo): static
    {
        $this->Sexo = $Sexo;

        return $this;
    }

    /**
     * @return Collection<int, Bono>
     */
    public function getBonos(): Collection
    {
        return $this->bonos;
    }

    public function addBono(Bono $bono): static
    {
        if (!$this->bonos->contains($bono)) {
            $this->bonos->add($bono);
            $bono->setUsuario($this);
        }

        return $this;
    }

    public function removeBono(Bono $bono): static
    {
        if ($this->bonos->removeElement($bono)) {
            // set the owning side to null (unless already changed)
            if ($bono->getUsuario() === $this) {
                $bono->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Nombre . " " . $this->Apellidos;
    }
}
