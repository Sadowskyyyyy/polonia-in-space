<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Entity\MarsResearchStation;
use App\Entity\MarsScientistEntity;
use App\Exception\CannotAddStartedOrFinishedExpeditionException;
use App\Exception\ExpeditionIsNotAlreadyFinishedException;
use App\Exception\ScientistIsAliveException;
use function array_map;

class MarsScientist extends AbstractScientist
{
    private bool $isMissing = false;
    private bool $isDead = false;
    private string $reason;
    private MarsScientist $author;
    private array $registeredUsers = [];
    private array $plannedExpeditions = [];
    private array $finishedExpeditions = [];

    public function __construct(
        string $name,
        string $surname,
        string $apikey,
        array  $registeredUsers,
        array  $plannedExpeditions,
        array  $finishedExpeditions
    )
    {
        parent::__construct($name, $surname, $apikey);
        $this->registeredUsers = $registeredUsers;
        $this->plannedExpeditions = $plannedExpeditions;
        $this->finishedExpeditions = $finishedExpeditions;
    }

    public static function createNewScientist(string $name, string $surname, string $apikey): self
    {
        return new self($name, $surname, $apikey, [], [], []);
    }

    public static function toEntity(self $marsScientist, MarsResearchStation $marsResearchStationEntity): MarsScientistEntity
    {
        $entity = new MarsScientistEntity(
            $marsScientist->getId(),
            $marsScientist->getName(),
            $marsScientist->getSurname(),
            $marsScientist->getApikey(),
            $marsScientist->isMissing(),
            $marsScientist->isDead(),
            $marsScientist->getReason(),
            self::toEntity($marsScientist->getAuthor(), $marsResearchStationEntity),
            $marsResearchStationEntity
        );

        $entity->setRegistredUsers(array_map(fn($user) => $user->toEntity(), $marsScientist->registeredUsers));

        return $entity;
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

    public function getAuthor(): self
    {
        return $this->author;
    }

    public function getRegisteredUsers(): array
    {
        return $this->registeredUsers;
    }

    public function addRegisteredUser(self $scientist): void
    {
        $this->registeredUsers[] = $scientist;
    }

    public function addPlanedExpedition(Expedition $expedition): void
    {
        if (true === $expedition->isStarted() || true === $expedition->isFinished()) {
            throw new CannotAddStartedOrFinishedExpeditionException();
        }

        $this->plannedExpeditions[] = $expedition;
    }

    public function addFinishedExpedition(Expedition $expedition): void
    {
        if (false === $expedition->isFinished()) {
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

    public function setReasonOfDeath(string $reason): void
    {
        if (false === $this->isDead) {
            throw new ScientistIsAliveException();
        }

        $this->reason = $reason;
    }

    public function getPlannedExpeditions(): array
    {
        return $this->plannedExpeditions;
    }

    public function getFinishedExpeditions(): array
    {
        return $this->finishedExpeditions;
    }

    public function setRegisteredUsers(array $registeredUsers): void
    {
        $this->registeredUsers = $registeredUsers;
    }
}
