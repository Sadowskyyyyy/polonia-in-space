<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\SpaceScientistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=SpaceScientistRepository::class)
 */
class SpaceScientist
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
     * @ORM\OneToMany(targetEntity=Delivery::class, mappedBy="sender")
     */
    private Collection $sentDeliveries;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private SpaceResearchStation $station;

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
        SpaceResearchStation $station,
        UserInterface $securityUser,
        string $apikey
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->station = $station;
        $this->securityUser = $securityUser;
        $this->apikey = $apikey;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getSentDeliveries(): Collection
    {
        return $this->sentDeliveries;
    }

    public function getStation(): SpaceResearchStation
    {
        return $this->station;
    }

    public function setStation(?SpaceResearchStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getSecurityUser(): UserInterface
    {
        return $this->securityUser;
    }

    public function setSecurityUser(UserInterface $securityUser): self
    {
        $this->securityUser = $securityUser;

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
}
