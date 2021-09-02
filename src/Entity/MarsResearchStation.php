<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\MarsResearchStationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarsResearchStationRepository::class)
 */
class MarsResearchStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $needHelp;

    /**
     * @ORM\OneToMany(targetEntity=MarsScientistEntity::class, mappedBy="station")
     */
    private array $scientists = [];

    /**
     * @ORM\ManyToOne(targetEntity=Event::class)
     */
    private array $events = [];

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private array $products = [];

    public static function toDomain(self $entity): \App\DomainModel\MarsResearchStation
    {
        return new \App\DomainModel\MarsResearchStation(
            $entity->id,
            $entity->scientists,
            $entity->products,
            $entity->events,
            $entity->needHelp
        );
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isNeedHelp(): bool
    {
        return $this->needHelp;
    }

    public function getScientists(): array
    {
        return $this->scientists;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): self
    {
        $this->products = $products;

        return $this;
    }
}
