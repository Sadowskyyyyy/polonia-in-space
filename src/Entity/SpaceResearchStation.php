<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\SpaceResearchStationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpaceResearchStationRepository::class)
 */
class SpaceResearchStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\OneToMany(targetEntity=SpaceScientist::class, mappedBy="station")
     */
    private array $scientists = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $needHelp;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $oxygenPercentage;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $daysAtOrbit;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $mass;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $energyWaste;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $accumulatorPercentage;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $position;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class)
     */
    private array $events = [];

    public function __construct(
        array $scientists,
        bool $needHelp,
        float $oxygenPercentage,
        int $daysAtOrbit,
        float $mass,
        float $energyWaste,
        float $accumulatorPercentage,
        float $position,
        array $events
    ) {
        $this->scientists = $scientists;
        $this->needHelp = $needHelp;
        $this->oxygenPercentage = $oxygenPercentage;
        $this->daysAtOrbit = $daysAtOrbit;
        $this->mass = $mass;
        $this->energyWaste = $energyWaste;
        $this->accumulatorPercentage = $accumulatorPercentage;
        $this->position = $position;
        $this->events = $events;
    }

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

    public function getNeedHelp(): ?bool
    {
        return $this->needHelp;
    }

    public function getOxygenPercentage(): ?float
    {
        return $this->oxygenPercentage;
    }

    public function getDaysAtOrbit(): ?int
    {
        return $this->daysAtOrbit;
    }

    public function getMass(): ?float
    {
        return $this->mass;
    }

    public function getEnergyWaste(): ?float
    {
        return $this->energyWaste;
    }

    public function getAccumulatorPercentage(): ?float
    {
        return $this->accumulatorPercentage;
    }

    public function getPosition(): ?float
    {
        return $this->position;
    }
}
