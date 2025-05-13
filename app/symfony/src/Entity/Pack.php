<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?int $nbLimitReservation = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?int $delayBooking = null;

    #[ORM\Column]
    private ?int $nbBookingByPerson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNbLimitReservation(): ?int
    {
        return $this->nbLimitReservation;
    }

    public function setNbLimitReservation(int $nbLimitReservation): static
    {
        $this->nbLimitReservation = $nbLimitReservation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDelayBooking(): ?int
    {
        return $this->delayBooking;
    }

    public function setDelayBooking(int $delayBooking): static
    {
        $this->delayBooking = $delayBooking;

        return $this;
    }

    public function getNbBookingByPerson(): ?int
    {
        return $this->nbBookingByPerson;
    }

    public function setNbBookingByPerson(int $nbBookingByPerson): static
    {
        $this->nbBookingByPerson = $nbBookingByPerson;

        return $this;
    }
}
