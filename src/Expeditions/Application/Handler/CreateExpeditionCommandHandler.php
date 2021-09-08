<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Handler;

use App\Expeditions\Application\Command\CreateExpeditionCommand;
use App\Expeditions\Domain\Entity\Expedition;
use App\Expeditions\Domain\ExpeditionRepository;
use App\Expeditions\Domain\MarsScientistRepository;
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
//        $user = $this->security->getUser();
        $scientist = $this->marsScientistRepository->findByApikey('asdsa');

        $date = \DateTime::createFromFormat('Y-m-d', $command->plannedStartDate);

        if (false === $date) {
            throw new \Exception();
        }

        $this->expeditionRepository->save(
            new Expedition(
                creator: null,
                name: $command->name,
                creationDate: new \DateTime(),
                plannedStartDate: $date,
            )
        );
    }
}
