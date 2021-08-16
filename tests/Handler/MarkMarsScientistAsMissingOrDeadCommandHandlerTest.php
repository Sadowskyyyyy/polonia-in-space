<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\DomainModel\MarsScientist;
use App\Handler\MarkMarsScientistAsMissingOrDeadCommandHandler;
use App\Service\MarsScientistRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MarkMarsScientistAsMissingOrDeadCommandHandlerTest extends KernelTestCase
{
    private MarkMarsScientistAsMissingOrDeadCommandHandler $handler;
    private MarsScientistRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(MarsScientistRepositoryInterface::class);
        $this->eventRepository = $this->createMock(EventRepositoryInterface::class);
        $this->handler = new MarkMarsScientistAsMissingOrDeadCommandHandler($this->repository, $this->eventRepository);
    }

    /** @test */
    public function should_mark_scientist_as_missing_with_valid_reason()
    {
        $this->doesNotPerformAssertions();
        $this->repository->method('getById')
            ->willReturn(new MarsScientist(1, 'Adam', 'Jensen', 'pass', [], [], []));

        $this->handler->__invoke(new MarkMarsScientistAsMissingOrDeadCommand(1, 'Adam fell off a cliff',
            true, false));
    }

    /** @test */
    public function should_mark_scientist_as_dead_with_valid_reason()
    {
        $this->doesNotPerformAssertions();
        $this->repository->method('getById')
            ->willReturn(new MarsScientist(1, 'Adam', 'Jensen', 'pass', [], [], []));

        $this->handler->__invoke(new MarkMarsScientistAsMissingOrDeadCommand(1, 'Adam fell off a cliff',
            false, true));
    }
}
