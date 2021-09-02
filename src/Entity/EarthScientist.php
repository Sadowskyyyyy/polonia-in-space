<?php
declare(strict_types=1);

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
    private int $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $apikey;

    /**
     * @ORM\ManyToOne(targetEntity=EarthResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private EarthResearchStation $station;

    public function __construct(int $id, string $name, string $surname, string $apikey, EarthResearchStation $station)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->apikey = $apikey;
        $this->station = $station;
    }

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

    public function getStation(): ?EarthResearchStation
    {
        return $this->station;
    }

    public function setStation(?EarthResearchStation $station): self
    {
        $this->station = $station;

        return $this;
    }
}
