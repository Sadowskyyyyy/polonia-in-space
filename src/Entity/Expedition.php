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
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="expeditionEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private MarsScientistEntity $creator;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $creationDate;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $plannedStartDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isFinished;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isStarted;

    public static function toDomain(self $expedition): \App\DomainModel\Expedition
    {
        return new \App\DomainModel\Expedition(
            $expedition->id,
            MarsScientistEntity::toDomain($expedition->creator),
            $expedition->isFinished,
            $expedition->isStarted
        );
    }

    public function __construct(MarsScientistEntity $creator, \DateTimeInterface $creationDate, ?\DateTimeInterface $plannedStartDate, bool $isFinished, bool $isStarted)
    {
        $this->id = 1;
        $this->creator = $creator;
        $this->creationDate = $creationDate;
        $this->plannedStartDate = $plannedStartDate;
        $this->isFinished = $isFinished;
        $this->isStarted = $isStarted;
    }
}
