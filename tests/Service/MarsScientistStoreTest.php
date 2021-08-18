<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Repository\MarsScientistEntityRepository;
use App\Service\MarsScientistStore;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MarsScientistStoreTest extends KernelTestCase
{
    private MarsScientistStore $marsScientistStore;
    private EntityManagerInterface $entityManager;
    private MarsScientistEntityRepository $scientistEntityRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->scientistEntityRepository = $this->createMock(MarsScientistEntityRepository::class);
        $this->marsScientistStore = new MarsScientistStore($this->entityManager);
    }

    /**@test */
    public function test_should_return_null_from_database()
    {
        $this->expectException(NotFoundException::class);
        $this->scientistEntityRepository->method('find')
            ->willReturn(null);
        $this->entityManager->method('getRepository')
            ->willReturn($this->scientistEntityRepository);

        $this->marsScientistStore->getById(1);
    }

    /**@test */
    public function test_should_return_expedition_from_database()
    {
        $this->expectException(NotFoundException::class);
        $this->scientistEntityRepository->method('find')
            ->willReturn(null);
        $this->entityManager->method('getRepository')
            ->willReturn($this->scientistEntityRepository);

        $this->marsScientistStore->getById(1);
    }
}
