<?php

namespace App\Entity;

use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=ExpeditionEntityRepository::class)
 */
class ExpeditionEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="expeditionEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="date")
     */
    private $plannedStartDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinished;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStarted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreator(): ?MarsScientistEntity
    {
        return $this->creator;
    }

    public function setCreator(?MarsScientistEntity $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getPlannedStartDate(): ?DateTimeInterface
    {
        return $this->plannedStartDate;
    }

    public function setPlannedStartDate(DateTimeInterface $plannedStartDate): self
    {
        $this->plannedStartDate = $plannedStartDate;

        return $this;
    }

    public function getIsFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    public function getIsStarted(): ?bool
    {
        return $this->isStarted;
    }

    public function setIsStarted(bool $isStarted): self
    {
        $this->isStarted = $isStarted;

        return $this;
    }
}
