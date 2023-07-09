<?php

namespace App\Entity;

use App\Repository\DiaTachadoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiaTachadoRepository::class)]
class DiaTachado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha = null;

    #[ORM\ManyToOne(inversedBy: 'diaTachados')]
    private ?Bono $Bono = null;

    public function __construct()
    {
        $this->Fecha = new \DateTime();
    }

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

    public function getBono(): ?Bono
    {
        return $this->Bono;
    }

    public function setBono(?Bono $Bono): static
    {
        $this->Bono = $Bono;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}
