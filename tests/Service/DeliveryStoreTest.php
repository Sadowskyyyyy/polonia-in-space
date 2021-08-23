<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Application\Shared\Domain\Exception\NotFoundException;
use App\Repository\DeliveryEntityRepository;
use App\Service\DeliveryStore;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DeliveryStoreTest extends KernelTestCase
{
    private DeliveryStore $deliveryStore;
    private EntityManagerInterface $entityManager;
    private DeliveryEntityRepository $deliveryRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->deliveryRepository = $this->createMock(DeliveryEntityRepository::class);
        $this->deliveryStore = new DeliveryStore($this->entityManager);
    }

    /**@test */
    public function test_should_return_null_from_database()
    {
        $this->expectException(NotFoundException::class);
        $this->deliveryRepository->method('find')
            ->willReturn(null);
        $this->entityManager->method('getRepository')
            ->willReturn($this->deliveryRepository);

        $this->assertEquals(null, $this->deliveryStore->getById(1));
    }
}
