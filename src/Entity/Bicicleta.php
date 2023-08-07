<?php

namespace App\Entity;

use App\Repository\BicicletaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BicicletaRepository::class)]
class Bicicleta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Estado = null;

    #[ORM\OneToMany(mappedBy: 'bicicleta', targetEntity: ReservaSpinning::class)]
    private Collection $ReservaSpinning;

    public function __construct()
    {
        $this->ReservaSpinning = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->Estado;
    }

    public function setEstado(string $Estado): static
    {
        $this->Estado = $Estado;

        return $this;
    }

    /**
     * @return Collection<int, ReservaSpinning>
     */
    public function getReservaSpinning(): Collection
    {
        return $this->ReservaSpinning;
    }

    public function addReservaSpinning(ReservaSpinning $reservaSpinning): static
    {
        if (!$this->ReservaSpinning->contains($reservaSpinning)) {
            $this->ReservaSpinning->add($reservaSpinning);
            $reservaSpinning->setBicicleta($this);
        }

        return $this;
    }

    public function removeReservaSpinning(ReservaSpinning $reservaSpinning): static
    {
        if ($this->ReservaSpinning->removeElement($reservaSpinning)) {
            // set the owning side to null (unless already changed)
            if ($reservaSpinning->getBicicleta() === $this) {
                $reservaSpinning->setBicicleta(null);
            }
        }

        return $this;
    }
}
