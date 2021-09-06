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
        string               $name,
        string               $surname,
        SpaceResearchStation $station,
        UserInterface        $securityUser,
        string               $apikey
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->station = $station;
        $this->securityUser = $securityUser;
        $this->apikey = $apikey;
    }
}
