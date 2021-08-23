<?php

declare(strict_types=1);

namespace App\Tests\Application\Scientist\Application;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use PHPStan\Testing\TestCase;
use RuntimeException;

class MarkScientistAsMissingOrDeadCommandTest extends TestCase
{
    private MarkMarsScientistAsMissingOrDeadCommand $command;

    /**
     * @doesNotPerformAssertions
     */
    public function testValidationWithValidData()
    {
        $this->doesNotPerformAssertions();
        $this->command = new MarkMarsScientistAsMissingOrDeadCommand(
            1,
            'In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Duis sapien nunc, commodo et,',
            false,
            true
        );
    }

    public function testValidationWithNotValidData()
    {
        $this->expectException(RuntimeException::class);

        $this->command = new MarkMarsScientistAsMissingOrDeadCommand(
            1,
            'In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Duis sapien nunc, commodo et,',
            true,
            true
        );
    }
}
