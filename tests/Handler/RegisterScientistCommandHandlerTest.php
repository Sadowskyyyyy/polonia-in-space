<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\Command\RegisterScientistCommand;
use App\Handler\RegisterScientistCommandHandler;
use App\Service\MarsScientistRepositoryInterface;
use App\Service\RegisterScientistCommandValidator;
use App\Shared\Domain\Event\EventRepositoryInterface;
use App\Shared\Domain\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RegisterScientistCommandHandlerTest extends KernelTestCase
{
    private MarsScientistRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;
    private RegisterScientistCommandValidator $validator;
    private RegisterScientistCommandHandler $handler;

    protected function setUp(): void
    {
        $this->eventRepository = $this->createMock(EventRepositoryInterface::class);
        $this->repository = $this->createMock(MarsScientistRepositoryInterface::class);
        $this->validator = new RegisterScientistCommandValidator();
        $this->handler = new RegisterScientistCommandHandler($this->repository, $this->eventRepository, $this->validator);
    }

    /**@test */
    public function should_create_valid_user()
    {
        $this->doesNotPerformAssertions();

        $this->handler->__invoke(new RegisterScientistCommand('Adam', 'Jensen'));
    }

    /**@test */
    public function test_given_not_valid_name_should_not_create_user_and_throw_error()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->handler->__invoke(new RegisterScientistCommand('A', 'Jensen'));
    }

    /**@test */
    public function test_given_not_valid_surname_should_not_create_user_and_throw_error_()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->handler->__invoke(new RegisterScientistCommand('Adam', 'Jj'));
    }
}
