<?php

namespace App\Entity;

use App\Repository\MarsResearchStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarsResearchStationRepository::class)
 */
class MarsResearchStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $needHelp;

    /**
     * @ORM\OneToMany(targetEntity=MarsScientistEntity::class, mappedBy="station")
     */
    private $scientists = [];

    public function __construct()
    {
        $this->scientists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|MarsScientistEntity[]
     */
    public function getScientists(): Collection
    {
        return $this->scientists;
    }

    public function addScientist(MarsScientistEntity $scientist): self
    {
        if (!$this->scientists->contains($scientist)) {
            $this->scientists[] = $scientist;
            $scientist->setStation($this);
        }

        return $this;
    }

    public function removeScientist(MarsScientistEntity $scientist): self
    {
        if ($this->scientists->removeElement($scientist)) {
            // set the owning side to null (unless already changed)
            if ($scientist->getStation() === $this) {
                $scientist->setStation(null);
            }
        }

        return $this;
    }
}
