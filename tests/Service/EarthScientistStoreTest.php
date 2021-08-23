<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\EarthScientistEntity;
use App\Repository\EarthScientistEntityRepository;
use App\Service\EarthScientistStore;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EarthScientistStoreTest extends KernelTestCase
{
    private EarthScientistStore $earthScientistStore;
    private EntityManagerInterface $entityManager;
    private EarthScientistEntityRepository $scientistEntityRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->scientistEntityRepository = $this->createMock(EarthScientistEntityRepository::class);
        $this->earthScientistStore = new EarthScientistStore($this->entityManager);
    }

    /**@test */
    public function test_should_return_null_from_database()
    {
        $this->expectException(NotFoundException::class);
        $this->scientistEntityRepository->method('find')
            ->willReturn(null);
        $this->entityManager->method('getRepository')
            ->willReturn($this->scientistEntityRepository);

        $this->earthScientistStore->getById(1);
    }

    /**@test */
    public function test_should_return_earth_scientist_from_database()
    {
        $earthScientist = new EarthScientistEntity(1, 'Adam', 'Jensen', 'pass', null);
        $this->scientistEntityRepository->method('find')
            ->willReturn($earthScientist);
        $this->entityManager->method('getRepository')
            ->willReturn($this->scientistEntityRepository);

        $this->assertEquals(EarthScientistEntity::toDomain($earthScientist), $this->earthScientistStore->getById(1));
    }
}
