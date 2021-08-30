<?php

namespace App\Entity;

use App\Repository\EarthScientistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EarthScientistRepository::class)
 */
class EarthScientist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=EarthResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $securityUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getStation(): ?EarthResearchStation
    {
        return $this->station;
    }

    public function setStation(?EarthResearchStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getSecurityUser(): ?User
    {
        return $this->securityUser;
    }

    public function setSecurityUser(User $securityUser): self
    {
        $this->securityUser = $securityUser;

        return $this;
    }
}
