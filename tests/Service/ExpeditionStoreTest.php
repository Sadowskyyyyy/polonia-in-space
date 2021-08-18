<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\ExpeditionEntity;
use App\Entity\MarsScientistEntity;
use App\Repository\ExpeditionEntityRepository;
use App\Service\ExpeditionStore;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExpeditionStoreTest extends KernelTestCase
{
    private ExpeditionStore $expeditionStore;
    private EntityManagerInterface $entityManager;
    private ExpeditionEntityRepository $expeditionEntityRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->expeditionEntityRepository = $this->createMock(ExpeditionEntityRepository::class);
        $this->expeditionStore = new ExpeditionStore($this->entityManager);
    }

    /**@test */
    public function test_should_return_null_from_database()
    {
        $this->expectException(NotFoundException::class);
        $this->expeditionEntityRepository->method('find')
            ->willReturn(null);
        $this->entityManager->method('getRepository')
            ->willReturn($this->expeditionEntityRepository);

        $this->expeditionStore->getById(1);
    }

    /**@test */
    public function test_should_return_expedition_from_database()
    {
        $expedition = new ExpeditionEntity(1,
            new MarsScientistEntity(1, 'Adam', 'Jensen', 'pass', false, true, 'I cat recall',
            null, new ArrayCollection(), null, new ArrayCollection(), new ArrayCollection())
            , null, null, false, false);
        $this->expeditionEntityRepository->method('find')
            ->willReturn($expedition);
        $this->entityManager->method('getRepository')
            ->willReturn($this->expeditionEntityRepository);

        $this->assertEquals(ExpeditionEntity::toDomain($expedition), $this->expeditionStore->getById(1));
    }
}
