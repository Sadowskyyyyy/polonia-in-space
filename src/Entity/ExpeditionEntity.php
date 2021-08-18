<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\Expedition;
use App\DomainModel\MarsScientist;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

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
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="expeditionEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?MarsScientistEntity $creator;

    /**
     * @ORM\Column(type="date")
     */
    private ?DateTimeInterface $creationDate;

    /**
     * @ORM\Column(type="date")
     */
    private ?DateTimeInterface $plannedStartDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isFinished;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isStarted;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="finishedExpeditions")
     */
    private $finishedBy;

    public function __construct(?int $id, ?MarsScientistEntity $creator, ?DateTimeInterface $creationDate, ?DateTimeInterface $plannedStartDate, ?bool $isFinished, ?bool $isStarted)
    {
        $this->id = $id;
        $this->creator = $creator;
        $this->creationDate = $creationDate;
        $this->plannedStartDate = $plannedStartDate;
        $this->isFinished = $isFinished;
        $this->isStarted = $isStarted;
    }

    public static function toDomain(ExpeditionEntity $entity): Expedition
    {
        return new Expedition(
            $entity->getId(),
            MarsScientistEntity::toDomain($entity->getCreator()),
            $entity->isFinished,
            $entity->isStarted
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

    public function getFinishedBy(): ?MarsScientistEntity
    {
        return $this->finishedBy;
    }

    public function setFinishedBy(?MarsScientistEntity $finishedBy): self
    {
        $this->finishedBy = $finishedBy;

        return $this;
    }
}
