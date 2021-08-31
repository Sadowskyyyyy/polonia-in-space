<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\EarthResarchStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    private ?int $id;

    /**
     * @ORM\OneToMany(targetEntity=EarthScientist::class, mappedBy="station")
     */
    private array $scientists;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $needHelp;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class)
     */
    private array $events = [];

    public function getEvents(): array
    {
        return $this->events;
    }
}
