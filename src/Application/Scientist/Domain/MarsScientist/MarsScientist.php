<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\MarsScientist;

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
        return new MarsScientist((int)null,
            $name, $surname,
            (string)null, null, null, null);
    }

    public function addRegisteredUser(MarsScientist $scientist): void
    {
        $this->registeredUsers[] = $scientist;
    }

    public function addPlanedExpedition(Expedition $expedition): void
    {
        $this->plannedExpeditions[] = $expedition;
    }

    public function addFinishedExpedition(Expedition $expedition): void
    {
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

    public function setReasonOfDeath(string $reason)
    {
        if ($this->isDead === false) {
            throw new ScientistIsAliveException();
        }

        $this->reason = $reason;
    }
}