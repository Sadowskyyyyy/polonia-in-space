<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Handler;

use App\DomainModel\Repository\ExpeditionRepository;
use App\Entity\Expedition;
use App\Expeditions\Application\Command\CreateExpeditionCommand;
use App\Service\AuthFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Security;

class CreateExpeditionCommandHandler implements MessageHandlerInterface
{
    private AuthFactory $authFactory;
    private Security $security;
    private ExpeditionRepository $expeditionRepository;

    public function __construct(AuthFactory $authFactory, Security $security, ExpeditionRepository $expeditionRepository)
    {
        $this->authFactory = $authFactory;
        $this->security = $security;
        $this->expeditionRepository = $expeditionRepository;
    }

    public function __invoke(CreateExpeditionCommand $command): void
    {
        $user = $this->security->getUser();
        $scientist = $this->authFactory->createFromUser($user);

        $expedition = new Expedition(
            creator: $scientist, creationDate: new \DateTime(), plannedStartDate: new \DateTime(),
            isFinished: false, isStarted: false
        );

        $this->expeditionRepository->save($expedition);
    }

}
