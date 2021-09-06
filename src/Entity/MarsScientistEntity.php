<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\MarsScientist;
use App\Repository\MarsScientistRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    public int $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    public string $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    public string $surname;

    /**
     * @ORM\Column(type="boolean")
     */
    public bool $isMissing = false;

    /**
     * @ORM\Column(type="boolean")
     */
    public bool $isDead = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $reason;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientistEntity::class, inversedBy="registredUsers")
     */
    public ?MarsScientistEntity $author;

    /**
     * @ORM\OneToMany(targetEntity=MarsScientistEntity::class, mappedBy="author")
     */
    public Collection $registredUsers;

    /**
     * @ORM\ManyToOne(targetEntity=MarsResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    public MarsResearchStation $station;

    /**
     * @ORM\OneToMany(targetEntity=Expedition::class, mappedBy="creator")
     */
    public Collection $expeditionEntities;

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
            $entity->name,
            $entity->surname,
            $entity->apikey,
            $entity->registredUsers->toArray(),
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

    public function __construct(
        string $name,
        string $surname,
        string $apikey,
        bool $isMissing,
        bool $isDead,
        ?string $reason,
        ?self $author,
        MarsResearchStation $station,
        Collection $registredUsers,
        Collection $expeditionEntities,
        User $user,
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
        $this->securityUser = $user;
        $this->apikey = $apikey;
    }

    public function setRegistredUsers(ArrayCollection $users): void
    {
        $this->registredUsers = $users;
    }
}
