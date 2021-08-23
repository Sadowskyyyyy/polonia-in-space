<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\SpaceScientistEntity;
use App\Repository\SpaceScientistEntityRepository;
use App\Service\SpaceScientistStore;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SpaceScientistStoreTest extends KernelTestCase
{
    private SpaceScientistStore $spaceScientistStore;
    private EntityManagerInterface $entityManager;
    private SpaceScientistEntityRepository $scientistEntityRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->scientistEntityRepository = $this->createMock(SpaceScientistEntityRepository::class);
        $this->spaceScientistStore = new SpaceScientistStore($this->entityManager);
    }

    /**@test */
    public function test_should_return_null_from_database()
    {
        $this->expectException(NotFoundException::class);
        $this->scientistEntityRepository->method('find')
            ->willReturn(null);
        $this->entityManager->method('getRepository')
            ->willReturn($this->scientistEntityRepository);

        $this->spaceScientistStore->getById(1);
    }

    /**@test */
    public function test_should_return_earth_scientist_from_database()
    {
        $spaceScientist =
            new SpaceScientistEntity(1, 'Adam', 'Jensen', [], null, 'pass');
        $this->scientistEntityRepository->method('find')
            ->willReturn($spaceScientist);
        $this->entityManager->method('getRepository')
            ->willReturn($this->scientistEntityRepository);

        $this->assertEquals(SpaceScientistEntity::toDomain($spaceScientist), $this->spaceScientistStore->getById(1));
    }

}