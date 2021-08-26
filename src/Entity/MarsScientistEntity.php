<?php

namespace App\Entity;

use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use App\Repository\MarsScientistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=MarsScientistRepository::class)
 */
class MarsScientistEntity implements UserInterface
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
     * @ORM\ManyToOne(targetEntity=MarsResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @ORM\OneToMany(targetEntity=Expedition::class, mappedBy="creator")
     */
    private $expeditionEntities;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    public function __construct(
        int $id,
        string $name,
        string $surname,
        string $password,
        bool $isMissing,
        bool $isDead,
        ?string $reason,
        ?self $author,
        array $registredUsers,
        $station
    ) {
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

    public static function toDomain(self $entity): MarsScientistEntity
    {
        return new MarsScientistEntity(
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getAuthor(): ?self
    {
        return $this->author;
    }

    public function setAuthor(?self $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getRegistredUsers(): Collection
    {
        return $this->registredUsers;
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

    public function getStation(): ?MarsResearchStation
    {
        return $this->station;
    }

    public function setStation(?MarsResearchStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    /**
     * @return Collection|Expedition[]
     */
    public function getExpeditionEntities(): Collection
    {
        return $this->expeditionEntities;
    }

    public function addExpeditionEntity(Expedition $expeditionEntity): self
    {
        if (!$this->expeditionEntities->contains($expeditionEntity)) {
            $this->expeditionEntities[] = $expeditionEntity;
            $expeditionEntity->setCreator($this);
        }

        return $this;
    }

    public function removeExpeditionEntity(Expedition $expeditionEntity): self
    {
        if ($this->expeditionEntities->removeElement($expeditionEntity)) {
            // set the owning side to null (unless already changed)
            if ($expeditionEntity->getCreator() === $this) {
                $expeditionEntity->setCreator(null);
            }
        }

        return $this;
    }

    public function getApikey(): ?string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): self
    {
        $this->apikey = $apikey;

        return $this;
    }
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword()
    {
        $this->password;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername(): string
    {
        return $this->name;
    }

    public function eraseCredentials()
    {
        return;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
