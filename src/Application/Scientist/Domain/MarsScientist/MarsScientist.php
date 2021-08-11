<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\MarsScientist;

use App\Application\Expedition\Domain\Exception\CannotAddStartedOrFinishedExpeditionException;
use App\Application\Expedition\Domain\Exception\ExpeditionIsNotAlreadyFinishedException;
use App\Application\Expedition\Domain\Expedition;
use App\Application\Scientist\Domain\AbstractScientist;
use App\Application\Scientist\Domain\Exception\ScientistIsAliveException;

class MarsScientist extends AbstractScientist
{
    private bool $isMissing;
    private bool $isDead;
    private string $reason;
    private array $registeredUsers = [];
    private array $plannedExpeditions = [];
    private array $finishedExpeditions = [];

    public function __construct(
        int    $id,
        string $name,
        string $surname,
        string $password,
        array  $registeredUsers,
        array  $plannedExpeditions,
        array  $finishedExpeditions)
    {
        parent::__construct($id, $name, $surname, $password);
        $this->registeredUsers = $registeredUsers;
        $this->plannedExpeditions = $plannedExpeditions;
        $this->finishedExpeditions = $finishedExpeditions;
    }

    public static function createNewScientist(string $name, string $surname): MarsScientist
    {
        return new MarsScientist((int)null, $name, $surname, '', [], [], []);
    }

    public function addRegisteredUser(MarsScientist $scientist): void
    {
        $this->registeredUsers[] = $scientist;
    }

    public function addPlanedExpedition(Expedition $expedition): void
    {
        if ($expedition->isStarted() === true || $expedition->isFinished() === true) {
            throw new CannotAddStartedOrFinishedExpeditionException();
        }

        $this->plannedExpeditions[] = $expedition;
    }

    public function addFinishedExpedition(Expedition $expedition): void
    {
        if ($expedition->isFinished() === false) {
            throw new ExpeditionIsNotAlreadyFinishedException();
        }

        $this->finishedExpeditions[] = $expedition;
    }

    public function markAsMissing(): void
    {
        $this->isMissing = true;
    }

    public function markAsDead(): void
    {
        $this->isDead = true;
        $this->isMissing = false;
    }

    public function markAsAlive(): void
    {
        $this->isDead = false;
        $this->isMissing = true;
    }

    public function setReasonOfDeath(string $reason)
    {
        if ($this->isDead === false) {
            throw new ScientistIsAliveException();
        }

        $this->reason = $reason;
    }

    public function isMissing(): bool
    {
        return $this->isMissing;
    }

    public function isDead(): bool
    {
        return $this->isDead;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getRegisteredUsers(): array
    {
        return $this->registeredUsers;
    }

    public function getPlannedExpeditions(): array
    {
        return $this->plannedExpeditions;
    }

    public function getFinishedExpeditions(): array
    {
        return $this->finishedExpeditions;
    }
}