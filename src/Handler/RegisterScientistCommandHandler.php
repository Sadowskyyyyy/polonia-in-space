<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\RegisterScientistCommand;
use App\Service\ScientistFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterScientistCommandHandler implements MessageHandlerInterface
{
    private ScientistFactory $factory;
    private EntityManagerInterface $entityManager;

    public function __construct(ScientistFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(RegisterScientistCommand $command): void
    {
        $scientist = $this->factory->createFromCommand($command);

        $this->entityManager->persist($scientist);
        $this->entityManager->flush();
    }
}
