s<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\Command\FinishExpeditionCommand;
use App\DomainModel\Expedition;
use App\DomainModel\MarsScientist;
use App\Exception\CannotFinishExpeditionWhichHasNotStartedYetException;
use App\Handler\FinishExpeditionCommandHandler;
use App\Service\ExpeditionRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FinishExpeditionCommandHandlerTest extends KernelTestCase
{
    private FinishExpeditionCommandHandler $handler;
    private ExpeditionRepositoryInterface $expeditionRepository;
    private EventRepositoryInterface $eventRepository;

    protected function setUp(): void
    {
        $this->expeditionRepository = $this->createMock(ExpeditionRepositoryInterface::class);
        $this->eventRepository = $this->createMock(EventRepositoryInterface::class);
        $this->handler = new FinishExpeditionCommandHandler($this->expeditionRepository, $this->eventRepository);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function should_finish_expedition()
    {
        $this->expeditionRepository->method('getById')
            ->willReturn(new Expedition(1,
                new MarsScientist(1, 'Adam', 'Jensen', 'pass', [], [], []),
                false, true));

        $this->handler->__invoke(new FinishExpeditionCommand(1));
    }

    /** @test */
    public function should_not_finish_expedition_and_throw_error()
    {
        $this->expectException(CannotFinishExpeditionWhichHasNotStartedYetException::class);
        $this->expeditionRepository->method('getById')
            ->willReturn(new Expedition(1,
                new MarsScientist(1, 'Adam', 'Jensen', 'pass', [], [], []),
                false, false));

        $this->handler->__invoke(new FinishExpeditionCommand(1));
    }
}
