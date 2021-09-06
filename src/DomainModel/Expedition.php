<?php

declare(strict_types=1);

namespace App\DomainModel;

use App\Exception\CannotFinishExpeditionWhichHasNotStartedYetException;
use App\Exception\CannotGenerateConclusionForNotFinishedExpeditionException;
use App\Exception\CannotStartFinishedExpeditionException;
use App\Exception\CannotStartStartedExpeditionException;
use DateTime;

class Expedition
{
    public const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    private int $id;
    private MarsScientist $creator;
    private string $creationDate;
    private string $plannedStartDate;
    private bool $isFinished = false;
    private bool $isStarted = false;

    public function __construct(
        int $id,
        MarsScientist $creator,
        bool $isFinished,
        bool $isStarted
    ) {
        $creationDate = new DateTime();
        $this->id = $id;
        $this->creator = $creator;
        $this->creationDate = $creationDate->format(self::DATE_TIME_FORMAT);
        $this->isFinished = $isFinished;
        $this->isStarted = $isStarted;
    }

    public static function planNewExpedition(MarsScientist $marsScientist, string $plannedStartDate): self
    {
        $expedition = new self((int) null, $marsScientist, false, false);
        $expedition->plannedStartDate = $plannedStartDate;

        return $expedition;
    }

    public function finish(): void
    {
        if (false === $this->isStarted) {
            throw new CannotFinishExpeditionWhichHasNotStartedYetException();
        }

        $this->isFinished = true;
    }

    public function start(): void
    {
        if (true === $this->isFinished) {
            throw new CannotStartFinishedExpeditionException();
        }
        if (true === $this->isStarted) {
            throw new CannotStartStartedExpeditionException();
        }

        $this->isStarted = true;
    }

    public function generateExpeditionConclusion(): string
    {
        if (false === $this->isFinished) {
            throw new CannotGenerateConclusionForNotFinishedExpeditionException();
        }

        return sprintf('creationDate: %1$s, plannedStartDate: %2$s', $this->creationDate, $this->plannedStartDate);
    }

    public function isStarted(): bool
    {
        return $this->isStarted;
    }

    public function isFinished(): bool
    {
        return $this->isFinished;
    }
}
