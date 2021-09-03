<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\SpaceScientistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpaceScientistRepository::class)
 */
class SpaceScientist
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
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="sender")
     */
    private Collection $sentDeliveries;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private SpaceResearchStation $station;

    public function __construct(string $name, string $surname, Collection $sentDeliveries, SpaceResearchStation $station)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->sentDeliveries = $sentDeliveries;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getSentDeliveries(): Collection
    {
        return $this->sentDeliveries;
    }

    public function getStation(): SpaceResearchStation
    {
        return $this->station;
    }
}
