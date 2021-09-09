<?php
declare(strict_types=1);

namespace App\Expeditions\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Expedition implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=MarsScientist::class, inversedBy="expeditionEntities")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?MarsScientist $creator;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $creationDate;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $plannedStartDate;

    public function __construct(?MarsScientist $creator, string $name, \DateTimeInterface $creationDate, \DateTimeInterface $plannedStartDate)
    {
        $this->creator = $creator;
        $this->name = $name;
        $this->creationDate = $creationDate;
        $this->plannedStartDate = $plannedStartDate;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'plannedStartDate' => $this->plannedStartDate->format('Y-m-d'),
            'creationDate'=>$this->creationDate->format('Y-m-d'),
        ];
    }
}
