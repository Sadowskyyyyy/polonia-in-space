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
}
