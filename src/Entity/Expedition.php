<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ExpeditionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpeditionRepository::class)
 */
class Expedition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="expeditionEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?MarsScientistEntity $creator;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $creationDate;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $plannedStartDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isFinished;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isStarted;

    public static function toDomain(self $expedition): \App\DomainModel\Expedition
    {
        return new \App\DomainModel\Expedition(
            $expedition->id,
            MarsScientistEntity::toDomain($expedition->creator),
            $expedition->isFinished,
            $expedition->isStarted
        );
    }

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getPlannedStartDate(): ?\DateTimeInterface
    {
        return $this->plannedStartDate;
    }

    public function setPlannedStartDate(\DateTimeInterface $plannedStartDate): self
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
