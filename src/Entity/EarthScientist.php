<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\EarthScientistRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=EarthScientistRepository::class)
 */
class EarthScientist
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
     * @ORM\ManyToOne(targetEntity=EarthResearchStation::class, inversedBy="scientists")
     * @ORM\JoinColumn(nullable=false)
     */
    public EarthResearchStation $station;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public UserInterface $securityUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $apikey;

    public function __construct(string $name, string $surname, EarthResearchStation $station, UserInterface $securityUser, string $apikey)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->station = $station;
        $this->securityUser = $securityUser;
        $this->apikey = $apikey;
    }
}
