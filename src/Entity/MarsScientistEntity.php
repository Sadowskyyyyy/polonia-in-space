<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\MarsScientist;
use App\Repository\MarsScientistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private UserInterface $securityUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $apikey;

    public function __construct(string $name, string $surname, bool $isMissing, bool $isDead, ?string $reason, ?MarsScientistEntity $author, array $registredUsers, MarsResearchStation $station, array $expeditionEntities, UserInterface $securityUser, string $apikey)
    {
    public function __construct(
        string $name,
        string $surname,
        string $apikey,
        bool $isMissing,
        bool $isDead,
        ?string $reason,
        ?self $author,
        MarsResearchStation $station
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->isMissing = $isMissing;
        $this->isDead = $isDead;
        $this->reason = $reason;
        $this->author = $author;
        $this->registredUsers = $registredUsers;
        $this->station = $station;
        $this->expeditionEntities = $expeditionEntities;
        $this->securityUser = $securityUser;
        $this->apikey = $apikey;
    }


    public function setRegistredUsers(Collection $registredUsers): void
    {
        $this->registredUsers = $registredUsers;
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

    public function setStation(MarsResearchStation $station): void
    {
        $this->station = $station;
    }

    public function getExpeditionEntities(): array
    {
        return $this->expeditionEntities;
    }
}
