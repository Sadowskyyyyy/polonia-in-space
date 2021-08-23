<?php
declare(strict_types=1);

namespace App\Service;

use App\Application\Shared\Domain\Exception\NotFoundException;
use App\DomainModel\Delivery;
use App\Entity\DeliveryEntity;
use Doctrine\ORM\EntityManagerInterface;

final class DeliveryStore implements DeliveryRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): ?Delivery
    {
        $entity = $this->entityManager->getRepository(DeliveryEntity::class)->find($id);

        if (empty($entity) === true) {
            throw new NotFoundException();
        }

        return DeliveryEntity::toDomain($entity);
    }
}
