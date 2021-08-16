<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\Handler\RegisterScientistCommandHandler;
use App\Service\MarsScientistRepositoryInterface;
use App\Service\RegisterScientistCommandValidator;
use App\Shared\Domain\Event\EventRepositoryInterface;
use phpDocumentor\Reflection\Types\This;
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
        $this->validator = $this->createMock(RegisterScientistCommandValidator::class);
        $this->repository = $this->createMock(MarsScientistRepositoryInterface::class);
        $this->handler = new RegisterScientistCommandHandler($this->repository, $this->eventRepository, $this->validator);
    }


}
