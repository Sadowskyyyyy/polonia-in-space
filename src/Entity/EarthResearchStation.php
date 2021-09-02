<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\EarthResarchStationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EarthResarchStationRepository::class)
 */
class EarthResearchStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToMany(targetEntity=EarthScientist::class, mappedBy="station")
     */
    private Collection $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $needHelp;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private Collection $events;

    /**
     * @ORM\Column(type="array")
     */
    private Collection $products;

    public static function toDomain(self $entity): \App\DomainModel\EarthResearchStation
    {
        return new \App\DomainModel\EarthResearchStation(
            $entity->id,
            $entity->scientists->toArray(),
            $entity->products->toArray(),
            $entity->events->toArray(),
            $entity->needHelp
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getScientists(): Collection
    {
        return $this->scientists;
    }

    public function isNeedHelp(): bool
    {
        return $this->needHelp;
    }

    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }
}
