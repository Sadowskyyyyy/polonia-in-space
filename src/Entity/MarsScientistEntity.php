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
    private ?MarsResearchStation $station;

    /**
     * @ORM\OneToMany(targetEntity=Expedition::class, mappedBy="creator")
     */
    private array $expeditionEntities = [];

    public function __construct(
        int     $id,
        string  $name,
        string  $surname,
        string  $apikey,
        bool    $isMissing,
        bool    $isDead,
        ?string $reason,
        ?self   $author,
                $station
    )
    {
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
            if ($expedition->isFinished() === true) {
                $finishedExpeditions[] = $expedition;
            }
        }

        return new MarsScientist(
            $entity->getId(),
            $entity->getName(),
            $entity->getSurname(),
            $entity->getApikey(),
            $entity->getRegistredUsers(),
            $plannedExpeditions,
            $finishedExpeditions
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getApikey(): string
    {
        return $this->apikey;
    }

    /**
     * @param string $apikey
     */
    public function setApikey(string $apikey): void
    {
        $this->apikey = $apikey;
    }

    /**
     * @return bool
     */
    public function isMissing(): bool
    {
        return $this->isMissing;
    }

    /**
     * @param bool $isMissing
     */
    public function setIsMissing(bool $isMissing): void
    {
        $this->isMissing = $isMissing;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->isDead;
    }

    /**
     * @param bool $isDead
     */
    public function setIsDead(bool $isDead): void
    {
        $this->isDead = $isDead;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @param string|null $reason
     */
    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return MarsScientistEntity|null
     */
    public function getAuthor(): ?MarsScientistEntity
    {
        return $this->author;
    }

    /**
     * @param MarsScientistEntity|null $author
     */
    public function setAuthor(?MarsScientistEntity $author): void
    {
        $this->author = $author;
    }

    /**
     * @return array
     */
    public function getRegistredUsers(): array
    {
        return $this->registredUsers;
    }

    /**
     * @param array $registredUsers
     */
    public function setRegistredUsers(array $registredUsers): void
    {
        $this->registredUsers = $registredUsers;
    }

    /**
     * @return MarsResearchStation|null
     */
    public function getStation(): ?MarsResearchStation
    {
        return $this->station;
    }

    /**
     * @param MarsResearchStation|null $station
     */
    public function setStation(?MarsResearchStation $station): void
    {
        $this->station = $station;
    }

    /**
     * @return array
     */
    public function getExpeditionEntities(): array
    {
        return $this->expeditionEntities;
    }

    /**
     * @param array $expeditionEntities
     */
    public function setExpeditionEntities(array $expeditionEntities): void
    {
        $this->expeditionEntities = $expeditionEntities;
    }

}
