<?php
declare(strict_types=1);

namespace App\Handler;

//TODO make tests
use App\Query\GetAllScientistsFromMarsResearchStationQuery;
use App\Service\MarsScientistRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetAllScientistsFromMarsResearchStationHandler implements MessageHandlerInterface
{
    private MarsScientistRepositoryInterface $marsScientistRepository;


    public function __construct(MarsScientistRepositoryInterface $marsScientistRepository)
    {
        $this->marsScientistRepository = $marsScientistRepository;
    }

    public function __invoke(GetAllScientistsFromMarsResearchStationQuery $query): array
    {
        return $this->marsScientistRepository->getAll();
    }
}
