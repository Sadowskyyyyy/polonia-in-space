<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\EarthResarchStationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EarthResarchStationRepository::class)
 */
class EarthResearchStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToMany(targetEntity=EarthScientist::class, mappedBy="station")
     */
    private array $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $needHelp;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class)
     */
    private array $events = [];

    public function getEvents(): array
    {
        return $this->events;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScientists(): array
    {
        return $this->scientists;
    }

    public function isNeedHelp(): bool
    {
        return $this->needHelp;
    }
}
