<?php

namespace App\Entity;

use App\Repository\SpaceResearchStationEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private $needHelp;

    /**
     * @ORM\Column(type="float")
     */
    private $oxygenPercentage;

    /**
     * @ORM\Column(type="integer")
     */
    private $daysAtOrbit;

    /**
     * @ORM\Column(type="float")
     */
    private $mass;

    /**
     * @ORM\Column(type="float")
     */
    private $energyWaste;

    /**
     * @ORM\Column(type="float")
     */
    private $accumulatorPercentage;

    /**
     * @ORM\Column(type="float")
     */
    private $position;

    public function __construct()
    {
        $this->scientists = new ArrayCollection();
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
