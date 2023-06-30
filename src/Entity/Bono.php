<?php

namespace App\Entity;

use App\Repository\BonoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BonoRepository::class)]
class Bono
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $Tipo = null;

    #[ORM\Column]
    private ?float $Precio = null;

    #[ORM\Column]
    private ?int $DiasTotales = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $FechaCreacion = null;

    #[ORM\ManyToOne(inversedBy: 'bonos')]
    private ?Usuario $Usuario = null;

    #[ORM\OneToMany(mappedBy: 'Bono', targetEntity: DiaTachado::class)]
    private Collection $diaTachados;

    public function __construct()
    {
        $this->diaTachados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->Tipo;
    }

    public function setTipo(string $Tipo): static
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->Precio;
    }

    public function setPrecio(float $Precio): static
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getDiasTotales(): ?int
    {
        return $this->DiasTotales;
    }

    public function setDiasTotales(int $DiasTotales): static
    {
        $this->DiasTotales = $DiasTotales;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->FechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $FechaCreacion): static
    {
        $this->FechaCreacion = $FechaCreacion;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->Usuario;
    }

    public function setUsuario(?Usuario $Usuario): static
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    /**
     * @return Collection<int, DiaTachado>
     */
    public function getDiaTachados(): Collection
    {
        return $this->diaTachados;
    }

    public function addDiaTachado(DiaTachado $diaTachado): static
    {
        if (!$this->diaTachados->contains($diaTachado)) {
            $this->diaTachados->add($diaTachado);
            $diaTachado->setBono($this);
        }

        return $this;
    }

    public function removeDiaTachado(DiaTachado $diaTachado): static
    {
        if ($this->diaTachados->removeElement($diaTachado)) {
            // set the owning side to null (unless already changed)
            if ($diaTachado->getBono() === $this) {
                $diaTachado->setBono(null);
            }
        }

        return $this;
    }
}
