<?php

declare(strict_types=1);

namespace App\Application\Expedition\Domain;

use App\Application\Scientist\Domain\MarsScientist;

class Expedition
{
    private int $id;
    private MarsScientist $creator;
    private string $creationDate;
    private string $plannedStartDate;
    private bool $isFinished;
    private bool $isStarted;

    public function __construct(
        int           $id,
        MarsScientist $creator,
        string        $plannedStartDate,
        bool          $isFinished,
        bool          $isStarted)
    {
        $creationDate = new \DateTime();
        $plannedStartDate = new \DateTime();
        $this->id = $id;
        $this->creator = $creator;
        $this->creationDate = $creationDate->format('Y-m-d H:i:s');
        $this->plannedStartDate = $plannedStartDate->format('Y-m-d H:i:s');
        $this->isFinished = $isFinished;
        $this->isStarted = $isStarted;
    }

    public static function planNewExpedition(MarsScientist $marsScientist, string $plannedStartDate): Expedition
    {
        return new Expedition((int)null, $marsScientist, $plannedStartDate, false, false);
    }

    public function finishExpedition(): void
    {
        if ($this->isStarted === true) {
            $this->isFinished = true;
        }
    }

    public function startExpedition(): void
    {
        if ($this->isFinished === false && $this->isStarted === false) {
            $this->isStarted = true;
        }
    }
}