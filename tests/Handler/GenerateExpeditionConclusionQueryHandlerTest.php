<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\Expedition;
use App\Handler\GenerateExpeditionConclusionQueryHandler;
use App\Service\ExpeditionRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GenerateExpeditionConclusionQueryHandlerTest extends KernelTestCase
{
    private GenerateExpeditionConclusionQueryHandler $handler;
    private ExpeditionRepositoryInterface $expeditionRepository;

    protected function setUp(): void
    {
        $this->expeditionRepository = $this->createMock(ExpeditionRepositoryInterface::class);
        $this->handler = new GenerateExpeditionConclusionQueryHandler($this->expeditionRepository);
    }

    /** @test */
    public function should_return_expedition_and_generate_conclusion()
    {
        $this->expeditionRepository->method('getById')
            ->willReturn(new Expedition(1, null, true, false));
       $expedition = new Expedition(1, null, true, false);
        dd($expedition->generateExpeditionConclusion());
//        $this->assertEquals();
    }


}