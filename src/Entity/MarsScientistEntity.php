<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\MarsScientistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
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
     * @ORM\Column(type="boolean")
     */
    public bool $isMissing = false;

    /**
     * @ORM\Column(type="boolean")
     */
    public bool $isDead = false;

    /**
     * @ORM\OneToMany(targetEntity=Expedition::class, mappedBy="creator")
     */
    public Collection $expeditionEntities;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private UserInterface $securityUser;

    public function __construct(
        int                 $id,
        string              $name,
        bool                $isMissing,
        bool                $isDead,
        Collection          $expeditionEntities,
        User                $user,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->isMissing = $isMissing;
        $this->isDead = $isDead;
        $this->expeditionEntities = $expeditionEntities;
        $this->securityUser = $user;
    }
}
