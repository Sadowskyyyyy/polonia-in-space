<?php

namespace App\Entity;

use App\Repository\EarthResarchStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=EarthScientist::class, mappedBy="station")
     */
    private array $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private $needHelp;

    public function __construct()
    {
        $this->scientists = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|EarthScientist[]
     */
    public function getScientists(): Collection
    {
        return $this->scientists;
    }

    public function addScientist(EarthScientist $scientist): self
    {
        if (!$this->scientists->contains($scientist)) {
            $this->scientists[] = $scientist;
            $scientist->setStation($this);
        }

        return $this;
    }

    public function removeScientist(EarthScientist $scientist): self
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
}
