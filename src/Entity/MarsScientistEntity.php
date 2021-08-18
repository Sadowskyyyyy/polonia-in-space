<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\MarsScientist;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarsScientistEntityRepository::class)
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
    private string $password;

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
    private ArrayCollection $registredUsers;

    /**
     * @ORM\ManyToOne(targetEntity=MarsResearchStationEntity::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?MarsResearchStationEntity $station;

    /**
     * @ORM\OneToMany(targetEntity=ExpeditionEntity::class, mappedBy="creator")
     */
    private ArrayCollection $plannedExpeditionsEntities;

    /**
     * @ORM\OneToMany(targetEntity=ExpeditionEntity::class, mappedBy="finishedBy")
     */
    private ArrayCollection $finishedExpeditions;

    public function __construct(int                        $id,
                                string                     $name,
                                string                     $surname,
                                string                     $password,
                                bool                       $isMissing,
                                bool                       $isDead,
                                ?string                    $reason,
                                ?MarsScientistEntity       $author,
                                ArrayCollection            $registredUsers,
                                ?MarsResearchStationEntity $station,
                                ArrayCollection            $expeditionEntities,
                                ArrayCollection            $finishedExpeditions)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->isMissing = $isMissing;
        $this->isDead = $isDead;
        $this->reason = $reason;
        $this->author = $author;
        $this->registredUsers = $registredUsers;
        $this->station = $station;
        $this->plannedExpeditionsEntities = $expeditionEntities;
        $this->finishedExpeditions = $finishedExpeditions;
    }

    public static function toDomain(self $entity): MarsScientist
    {
        return new MarsScientist(
            $entity->getId(),
            $entity->getName(),
            $entity->getSurname(),
            $entity->getPassword(),
            $entity->getRegistredUsers(),
            $entity->getPlannedExpeditions(),
            $entity->getFinishedExpeditions()
        );
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegistredUsersEntites(): Collection
    {
        return $this->registredUsers;
    }

    public function getIsMissing(): ?bool
    {
        return $this->isMissing;
    }

    public function setIsMissing(bool $isMissing): self
    {
        $this->isMissing = $isMissing;

        return $this;
    }

    public function getIsDead(): ?bool
    {
        return $this->isDead;
    }

    public function setIsDead(bool $isDead): self
    {
        $this->isDead = $isDead;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function addRegistredUser(self $registredUser): self
    {
        if (!$this->registredUsers->contains($registredUser)) {
            $this->registredUsers[] = $registredUser;
            $registredUser->setAuthor($this);
        }

        return $this;
    }

    public function removeRegistredUser(self $registredUser): self
    {
        if ($this->registredUsers->removeElement($registredUser)) {
            // set the owning side to null (unless already changed)
            if ($registredUser->getAuthor() === $this) {
                $registredUser->setAuthor(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?self
    {
        return $this->author;
    }

    public function setAuthor(?self $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getStation(): ?MarsResearchStationEntity
    {
        return $this->station;
    }

    public function setStation(?MarsResearchStationEntity $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getPlannedExpeditionsEntities(): Collection
    {
        return $this->plannedExpeditionsEntities;
    }

    public function addExpeditionEntity(ExpeditionEntity $expeditionEntity): self
    {
        if (!$this->plannedExpeditionsEntities->contains($expeditionEntity)) {
            $this->plannedExpeditionsEntities[] = $expeditionEntity;
            $expeditionEntity->setCreator($this);
        }

        return $this;
    }

    public function removeExpeditionEntity(ExpeditionEntity $expeditionEntity): self
    {
        if ($this->plannedExpeditionsEntities->removeElement($expeditionEntity)) {
            // set the owning side to null (unless already changed)
            if ($expeditionEntity->getCreator() === $this) {
                $expeditionEntity->setCreator(null);
            }
        }

        return $this;
    }

    public function getPlannedExpeditions(): array
    {
        $expeditions = [];

        foreach ($this->plannedExpeditionsEntities as $expeditionEntity) {
            /**@var ExpeditionEntity $expeditionEntity */
            $expeditions[] = ExpeditionEntity::toDomain($expeditionEntity);
        }

        return $expeditions;
    }

    public function getRegistredUsers(): array
    {
        $users = [];

        foreach ($this->registredUsers as $marsScientist) {
            /**@var MarsScientistEntity $marsScientist */
            $users[] = MarsScientistEntity::toDomain($marsScientist);
        }

        return $users;
    }

    public function getFinishedExpeditions(): array
    {
        $expeditions = [];

        foreach ($this->plannedExpeditionsEntities as $expeditionEntity) {
            /**@var ExpeditionEntity $expeditionEntity */
            $expeditions[] = ExpeditionEntity::toDomain($expeditionEntity);
        }

        return $expeditions;
    }

    public function getFinishedExpeditionsEntities(): Collection
    {
        return $this->finishedExpeditions;
    }

    public function addFinishedExpedition(ExpeditionEntity $finishedExpedition): self
    {
        if (!$this->finishedExpeditions->contains($finishedExpedition)) {
            $this->finishedExpeditions[] = $finishedExpedition;
            $finishedExpedition->setFinishedBy($this);
        }

        return $this;
    }

    public function removeFinishedExpedition(ExpeditionEntity $finishedExpedition): self
    {
        if ($this->finishedExpeditions->removeElement($finishedExpedition)) {
            // set the owning side to null (unless already changed)
            if ($finishedExpedition->getFinishedBy() === $this) {
                $finishedExpedition->setFinishedBy(null);
            }
        }

        return $this;
    }
}
