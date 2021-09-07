<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Handler;

use App\DomainModel\Repository\ExpeditionRepository;
use App\DomainModel\Repository\MarsScientistRepository;
use App\Entity\Expedition;
use App\Expeditions\Application\Command\CreateExpeditionCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Security;

class CreateExpeditionCommandHandler implements MessageHandlerInterface
{
    private Security $security;
    private ExpeditionRepository $expeditionRepository;
    private MarsScientistRepository $marsScientistRepository;

    public function __construct(Security $security, ExpeditionRepository $expeditionRepository, MarsScientistRepository $marsScientistRepository)
    {
        $this->security = $security;
        $this->expeditionRepository = $expeditionRepository;
        $this->marsScientistRepository = $marsScientistRepository;
    }

    public function __invoke(CreateExpeditionCommand $command): void
    {
        $user = $this->security->getUser();
        $scientist = $this->marsScientistRepository->findByApikey($user->getUsername());

        $expedition = new Expedition(
            creator: $scientist,
            creationDate: new \DateTime(),
            plannedStartDate: new \DateTime(),
            isFinished: false,
            isStarted: false
        );

        $this->expeditionRepository->save($expedition);
    }
}
