<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EarthResarchStationRepository::class)
 */
class EarthResarchStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=EarthScientistEntity::class, mappedBy="station")
     */
    private ArrayCollection $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $needHelp;

    public function __construct($id, ArrayCollection $scientists, ?bool $needHelp)
    {
        $this->id = $id;
        $this->scientists = $scientists;
        $this->needHelp = $needHelp;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|EarthScientistEntity[]
     */
    public function getScientists(): Collection
    {
        return $this->scientists;
    }

    public function addScientist(EarthScientistEntity $scientist): self
    {
        if (!$this->scientists->contains($scientist)) {
            $this->scientists[] = $scientist;
            $scientist->setStation($this);
        }

        return $this;
    }

    public function removeScientist(EarthScientistEntity $scientist): self
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
