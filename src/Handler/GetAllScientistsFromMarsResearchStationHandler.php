<?php

declare(strict_types=1);

namespace App\Handler;

use App\Application\Scientist\Application\Query\GetAllScientistsFromMarsResearchStation;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

//TODO make tests
class GetAllScientistsFromMarsResearchStationHandler implements MessageHandlerInterface
{
    private MarsScientistRepositoryInterface $marsScientistRepository;

    public function __invoke(GetAllScientistsFromMarsResearchStation $query): array
    {
        return $this->marsScientistRepository->getAll();
    }

}