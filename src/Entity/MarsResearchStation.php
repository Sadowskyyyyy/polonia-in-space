<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\MarsResearchStationRepository;
use Doctrine\Common\Collections\Collection;
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
    private Collection $scientists;

    /**
     * @ORM\Column(type="array")
     */
    private Collection $events;

    /**
     * @ORM\Column(type="array")
     */
    private Collection $products;

    public static function toDomain(self $entity): \App\DomainModel\MarsResearchStation
    {
        return new \App\DomainModel\MarsResearchStation(
            $entity->id,
            $entity->scientists->toArray(),
            $entity->products->toArray(),
            $entity->events->toArray(),
            $entity->needHelp
        );
    }

    public function __construct(bool $needHelp, Collection $scientists, Collection $events, Collection $products)
    {
        $this->needHelp = $needHelp;
        $this->scientists = $scientists;
        $this->events = $events;
        $this->products = $products;
    }

    public function getEvents(): Collection
    {
        return $this->events;
    }
}
