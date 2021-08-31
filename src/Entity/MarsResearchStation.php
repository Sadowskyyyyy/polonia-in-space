<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\MarsResearchStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    private array $scientists = [];

}
