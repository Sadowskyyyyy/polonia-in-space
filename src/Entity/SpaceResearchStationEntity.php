<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SpaceResearchStationEntityRepository::class)
 */
class SpaceResearchStationEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=SpaceScientistEntity::class, mappedBy="station")
     */
    private ArrayCollection $scientists;

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

    public function __construct($id, ArrayCollection $scientists, ?bool $needHelp, ?float $oxygenPercentage, ?int $daysAtOrbit, ?float $mass, ?float $energyWaste, ?float $accumulatorPercentage, ?float $position)
    {
        $this->id = $id;
        $this->scientists = $scientists;
        $this->needHelp = $needHelp;
        $this->oxygenPercentage = $oxygenPercentage;
        $this->daysAtOrbit = $daysAtOrbit;
        $this->mass = $mass;
        $this->energyWaste = $energyWaste;
        $this->accumulatorPercentage = $accumulatorPercentage;
        $this->position = $position;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|SpaceScientistEntity[]
     */
    public function getScientists(): Collection
    {
        return $this->scientists;
    }

    public function addScientist(SpaceScientistEntity $scientist): self
    {
        if (!$this->scientists->contains($scientist)) {
            $this->scientists[] = $scientist;
            $scientist->setStation($this);
        }

        return $this;
    }

    public function removeScientist(SpaceScientistEntity $scientist): self
    {
        if ($this->scientists->removeElement($scientist)) {
            // set the owning side to null (unless already changed)
            if ($scientist->getStation() === $this) {
                $scientist->setStation(null);
            }
        }

        return $this;
    }

    public function getNeedHelp(): ?bool
    {
        return $this->needHelp;
    }

    public function setNeedHelp(bool $needHelp): self
    {
        $this->needHelp = $needHelp;

        return $this;
    }

    public function getOxygenPercentage(): ?float
    {
        return $this->oxygenPercentage;
    }

    public function setOxygenPercentage(float $oxygenPercentage): self
    {
        $this->oxygenPercentage = $oxygenPercentage;

        return $this;
    }

    public function getDaysAtOrbit(): ?int
    {
        return $this->daysAtOrbit;
    }

    public function setDaysAtOrbit(int $daysAtOrbit): self
    {
        $this->daysAtOrbit = $daysAtOrbit;

        return $this;
    }

    public function getMass(): ?float
    {
        return $this->mass;
    }

    public function setMass(float $mass): self
    {
        $this->mass = $mass;

        return $this;
    }

    public function getEnergyWaste(): ?float
    {
        return $this->energyWaste;
    }

    public function setEnergyWaste(float $energyWaste): self
    {
        $this->energyWaste = $energyWaste;

        return $this;
    }

    public function getAccumulatorPercentage(): ?float
    {
        return $this->accumulatorPercentage;
    }

    public function setAccumulatorPercentage(float $accumulatorPercentage): self
    {
        $this->accumulatorPercentage = $accumulatorPercentage;

        return $this;
    }

    public function getPosition(): ?float
    {
        return $this->position;
    }

    public function setPosition(float $position): self
    {
        $this->position = $position;

        return $this;
    }
}
