<?php

namespace App\Entity;

use App\event\TimeEventInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParkPlaceRepository")
 */
class ParkPlace implements TimeEventInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="parkPlaces")
     */
    private $user;
    private $createdAt;
    private $updatedAt;

    /**
     * ParkPlace constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        $this->updatedAt = new DateTimeImmutable();
        return $this;
    }

    public function createdAt()
    {
        return $this->createdAt();
    }


    public function updatedAt()
    {
        return $this->updatedAt();
    }

    public function __toString()
    {
        return 'ParkPlace: id = '.$this->id.' number = '.$this->number.' user = '.$this->user;
    }
}
