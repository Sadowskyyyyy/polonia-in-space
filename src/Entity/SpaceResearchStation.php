<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\SpaceResearchStationRepository;
use Doctrine\Common\Collections\Collection;
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
    private int $id;

    /**
     * @ORM\OneToMany(targetEntity=SpaceScientist::class, mappedBy="station")
     */
    private Collection $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $needHelp;

    /**
     * @ORM\Column(type="float")
     */
    private float $oxygenPercentage;

    /**
     * @ORM\Column(type="integer")
     */
    private int $daysAtOrbit;

    /**
     * @ORM\Column(type="float")
     */
    private float $mass;

    /**
     * @ORM\Column(type="float")
     */
    private float $energyWaste;

    /**
     * @ORM\Column(type="float")
     */
    private float $accumulatorPercentage;

    /**
     * @ORM\Column(type="float")
     */
    private float $position;

    /**
     * @ORM\Column(type="float")
     */
    private float $waterWaste;

    /**
     * @ORM\Column(type="array")
     */
    private Collection $events;

    /**
     * @ORM\Column(type="array")
     */
    private Collection $products;

    public function __construct(
        Collection $scientists,
        bool       $needHelp,
        float      $oxygenPercentage,
        int        $daysAtOrbit,
        float      $mass,
        float      $energyWaste,
        float      $accumulatorPercentage,
        float      $position,
        Collection $events
    )
    {
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

    public static function toDomain(self $entity): \App\DomainModel\SpaceResearchStation
    {
        return new \App\DomainModel\SpaceResearchStation(
            $entity->id,
            $entity->oxygenPercentage,
            $entity->daysAtOrbit,
            $entity->mass,
            $entity->energyWaste,
            $entity->waterWaste,
            $entity->accumulatorPercentage,
            $entity->position,
            $entity->scientists->toArray(),
            $entity->products->toArray(),
            $entity->events->toArray(),
            $entity->needHelp
        );
    }

    public function getEvents(): Collection
    {
        return $this->events;
    }
}
