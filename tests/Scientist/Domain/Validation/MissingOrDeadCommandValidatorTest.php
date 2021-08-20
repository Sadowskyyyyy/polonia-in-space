<?php
declare(strict_types=1);

namespace App\Tests\Scientist\Domain\Validation;

use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Exception\InvalidReasonException;
use App\Service\MissingOrDeadCommandValidator;
use App\Shared\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MissingOrDeadCommandValidatorTest extends TestCase
{
    private MissingOrDeadCommandValidator $validator;
    private MarkMarsScientistAsMissingOrDeadCommand $command;

    protected function setUp(): void
    {
        $this->validator = new MissingOrDeadCommandValidator();
        $this->command = new MarkMarsScientistAsMissingOrDeadCommand(
            1,
            'In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Duis sapien nunc, commodo et,',
            false,
            true
        );
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testValidationForCommandWithValidData()
    {
        $this->command->isDead = true;
        $this->command->isMissing = false;

        $this->validator->isValid($this->command);
    }

    /** @test */
    public function testValidationForCommandWithInvalidArguments()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->command->isDead = false;
        $this->command->isMissing = false;

        $this->validator->isValid($this->command);
    }

    /** @test */
    public function testValidationForCommandWithInvalidReason()
    {
        $this->expectException(InvalidReasonException::class);
        $this->command->reason = 'Blabla';

        $this->validator->isValid($this->command);
    }
}
