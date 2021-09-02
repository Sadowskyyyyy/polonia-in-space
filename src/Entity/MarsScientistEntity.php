<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\MarsScientist;
use App\Repository\MarsScientistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarsScientistRepository::class)
 */
class MarsScientistEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $apikey;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isMissing = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isDead = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reason;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="registredUsers")
     */
    private ?MarsScientistEntity $author;

    /**
     * @ORM\OneToMany(targetEntity=MarsScientistEntity::class, mappedBy="author")
     */
    private Collection $registredUsers;

    /**
     * @ORM\ManyToOne(targetEntity=MarsResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private MarsResearchStation $station;

    /**
     * @ORM\OneToMany(targetEntity=Expedition::class, mappedBy="creator")
     */
    private Collection $expeditionEntities;

    public function __construct(
        int $id,
        string $name,
        string $surname,
        string $apikey,
        bool $isMissing,
        bool $isDead,
        ?string $reason,
        ?self $author,
        MarsResearchStation $station
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->apikey = $apikey;
        $this->isMissing = $isMissing;
        $this->isDead = $isDead;
        $this->reason = $reason;
        $this->author = $author;
        $this->station = $station;
    }

    /**
     * @param Collection $registredUsers
     */
    public function setRegistredUsers(Collection $registredUsers): void
    {
        $this->registredUsers = $registredUsers;
    }

    public static function toDomain(self $entity): MarsScientist
    {
        $plannedExpeditions = [];
        $finishedExpeditions = [];

        foreach ($entity->expeditionEntities->toArray() as $expeditionEntity) {
            $plannedExpeditions[] = Expedition::toDomain($expeditionEntity);
        }

        foreach ($plannedExpeditions as $expedition) {
            if (true === $expedition->isFinished()) {
                $finishedExpeditions[] = $expedition;
            }
        }

        return new MarsScientist(
            $entity->getName(),
            $entity->getSurname(),
            $entity->getApikey(),
            $entity->getRegistredUsers()->toArray(),
            $plannedExpeditions,
            $finishedExpeditions
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getApikey(): string
    {
        return $this->apikey;
    }

    public function isMissing(): bool
    {
        return $this->isMissing;
    }

    public function isDead(): bool
    {
        return $this->isDead;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getAuthor(): ?self
    {
        return $this->author;
    }

    public function getRegistredUsers(): Collection
    {
        return $this->registredUsers;
    }

    public function getStation(): MarsResearchStation
    {
        return $this->station;
    }

    public function getExpeditionEntities(): Collection
    {
        return $this->expeditionEntities;
    }
}
