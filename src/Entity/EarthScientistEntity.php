<?php
declare(strict_types=1);

namespace App\Entity;

use App\DomainModel\EarthScientist;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EarthScientistEntityRepository::class)
 */
class EarthScientistEntity implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private ?string $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $password;

    /**
     * @ORM\ManyToOne(targetEntity=EarthResarchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?EarthResarchStation $station;


    public function __construct($id, ?string $name, ?string $surname, ?string $password, ?EarthResarchStation $station)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->station = $station;
    }

    public static function toDomain(EarthScientistEntity $entity): EarthScientist
    {
        return new EarthScientist(
            $entity->getId(),
            $entity->getName(),
            $entity->getSurname(),
            $entity->getPassword()
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

    public function getStation(): ?EarthResarchStation
    {
        return $this->station;
    }

    public function setStation(?EarthResarchStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getRoles()
    {
        $roles[] = 'ROLE_EARTH_SCIENTIST';

        return array_unique($roles);
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername(): string
    {
        return $this->name;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
