<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SpaceScientistEntityRepository::class)
 */
class SpaceScientistEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity=DeliveryEntity::class, mappedBy="sender")
     */
    private $sentDeliveries;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceResearchStationEntity::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    public function __construct()
    {
        $this->sentDeliveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|DeliveryEntity[]
     */
    public function getSentDeliveries(): Collection
    {
        return $this->sentDeliveries;
    }

    public function addSentDelivery(DeliveryEntity $sentDelivery): self
    {
        if (!$this->sentDeliveries->contains($sentDelivery)) {
            $this->sentDeliveries[] = $sentDelivery;
            $sentDelivery->setSender($this);
        }

        return $this;
    }

    public function removeSentDelivery(DeliveryEntity $sentDelivery): self
    {
        if ($this->sentDeliveries->removeElement($sentDelivery)) {
            // set the owning side to null (unless already changed)
            if ($sentDelivery->getSender() === $this) {
                $sentDelivery->setSender(null);
            }
        }

        return $this;
    }

    public function getStation(): ?SpaceResearchStationEntity
    {
        return $this->station;
    }

    public function setStation(?SpaceResearchStationEntity $station): self
    {
        $this->station = $station;

        return $this;
    }
}
