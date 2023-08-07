<?php

namespace App\Entity;

use App\Repository\ReservaSpinningRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservaSpinningRepository::class)]
class ReservaSpinning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha = null;

    #[ORM\ManyToOne(inversedBy: 'ReservaSpinning')]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(inversedBy: 'ReservaSpinning')]
    private ?Bicicleta $bicicleta = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): static
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getBicicleta(): ?Bicicleta
    {
        return $this->bicicleta;
    }

    public function setBicicleta(?Bicicleta $bicicleta): static
    {
        $this->bicicleta = $bicicleta;

        return $this;
    }
}
