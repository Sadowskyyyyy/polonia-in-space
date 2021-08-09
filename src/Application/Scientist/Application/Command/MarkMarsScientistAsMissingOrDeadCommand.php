<?php

namespace App\Application\Scientist\Application\Command;


use App\Application\Shared\Application\Command\CommandInterface;
use RuntimeException;

class MarkMarsScientistAsMissingOrDeadCommand implements CommandInterface
{
    public int $id;
    public string $reason;
    public bool $isMissing;
    public bool $isDead;

    public function __construct(int $id, string $reason, bool $isMissing, bool $isDead)
    {
        $this->id = $id;
        $this->reason = $reason;
        $this->isMissing = $isMissing;
        $this->isDead = $isDead;
        $this->validate();
    }

    private function validate()
    {
        if (($this->isDead === true && $this->isMissing === true)
            || ($this->isDead === false && $this->isMissing === false)) {
            throw new RuntimeException('Data is not valid');
        }
    }
}