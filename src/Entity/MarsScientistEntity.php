<?php

namespace App\Entity;

use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
    private $station;

    /**
     * @ORM\OneToMany(targetEntity=ExpeditionEntity::class, mappedBy="creator")
     */
    private $expeditionEntities;

    public function __construct(int     $id, string $name, string $surname,
                                string  $password, bool $isMissing, bool $isDead,
                                ?string $reason
        , ?MarsScientistEntity          $author, array $registredUsers, $station)
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
        $this->expeditionEntities = new ArrayCollection();
    }


    public static function toDomain(MarsScientistEntity $entity): MarsScientist
    {
        return new MarsScientist(
            $entity->getId(),
            $entity->getName(),
            $entity->getSurname(),
            $entity->getPassword(),
            $entity->getRegistredUsers(),
            $entity->getPlannedExpedition(),
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

    /**
     * @return Collection|self[]
     */
    public function getRegistredUsers(): Collection
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

    /**
     * @return Collection|ExpeditionEntity[]
     */
    public function getExpeditionEntities(): Collection
    {
        return $this->expeditionEntities;
    }

    public function addExpeditionEntity(ExpeditionEntity $expeditionEntity): self
    {
        if (!$this->expeditionEntities->contains($expeditionEntity)) {
            $this->expeditionEntities[] = $expeditionEntity;
            $expeditionEntity->setCreator($this);
        }

        return $this;
    }

    public function removeExpeditionEntity(ExpeditionEntity $expeditionEntity): self
    {
        if ($this->expeditionEntities->removeElement($expeditionEntity)) {
            // set the owning side to null (unless already changed)
            if ($expeditionEntity->getCreator() === $this) {
                $expeditionEntity->setCreator(null);
            }
        }

        return $this;
    }
}
