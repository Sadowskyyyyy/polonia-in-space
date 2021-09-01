<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\MarsScientist;
use App\Repository\MarsScientistRepository;
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
    private array $registredUsers = [];

    /**
     * @ORM\ManyToOne(targetEntity=MarsResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private MarsResearchStation $station;

    /**
     * @ORM\OneToMany(targetEntity=Expedition::class, mappedBy="creator")
     */
    private array $expeditionEntities = [];

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

    public static function toDomain(self $entity): MarsScientist
    {
        $plannedExpeditions = [];
        $finishedExpeditions = [];

        foreach ($entity->expeditionEntities as $expeditionEntity) {
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
            $entity->getRegistredUsers(),
            $plannedExpeditions,
            $finishedExpeditions
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getApikey(): string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): void
    {
        $this->apikey = $apikey;
    }

    public function isMissing(): bool
    {
        return $this->isMissing;
    }

    public function setIsMissing(bool $isMissing): void
    {
        $this->isMissing = $isMissing;
    }

    public function isDead(): bool
    {
        return $this->isDead;
    }

    public function setIsDead(bool $isDead): void
    {
        $this->isDead = $isDead;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    public function getAuthor(): ?self
    {
        return $this->author;
    }

    public function setAuthor(?self $author): void
    {
        $this->author = $author;
    }

    public function getRegistredUsers(): array
    {
        return $this->registredUsers;
    }

    public function setRegistredUsers(array $registredUsers): void
    {
        $this->registredUsers = $registredUsers;
    }

    public function getStation(): ?MarsResearchStation
    {
        return $this->station;
    }

    public function setStation(?MarsResearchStation $station): void
    {
        $this->station = $station;
    }

    public function getExpeditionEntities(): array
    {
        return $this->expeditionEntities;
    }

    public function setExpeditionEntities(array $expeditionEntities): void
    {
        $this->expeditionEntities = $expeditionEntities;
    }
}
