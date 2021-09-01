<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\RegisterScientistCommand;
use App\Entity\EarthScientist;
use App\Entity\MarsScientistEntity;
use App\Entity\SpaceScientist;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ScientistFactory
{
    const EARTH_SCIENTIST = 'earthstation';
    const SPACE_SCIENTIST = 'spacestation';
    const MARS_SCIENTIST = 'marsstation';

    private ResarchStationRepositoryInterface $researchStationRepository;
    private ApiKeyGenerator $apiKeyGenerator;
    private EntityManagerInterface $entityManager;

    public function createFromCommand(RegisterScientistCommand $command,)
    {
        $scientist = null;
        $station = $this->researchStationRepository->getResarchStationEntityByName($command->station);
        $apikey = $this->apiKeyGenerator->generateApiKey();

        switch ($command->station) {
            case self::EARTH_SCIENTIST:
                $scientist = new EarthScientist(
                    $command->name,
                    $command->surname,
                    $station,
                    new User($command->name, ['ROLE_EARTH_SCIENTIST'], $apikey),
                    $apikey
                );
                break;
            case self::SPACE_SCIENTIST:
                $scientist = new SpaceScientist(
                    $command->name,
                    $command->surname,
                    $station,
                    new User($command->name, ['ROLE_SPACE_SCIENTIST'], $apikey),
                    $apikey
                );
                break;
            case self::MARS_SCIENTIST:
                $scientist = new MarsScientistEntity(
                    $command->name,
                    $command->surname,
                    null,
                    $station,
                    new User($command->name, ['ROLE_MARS_SCIENTIST'], $apikey),
                    $apikey
                );
                break;
        }

        $this->entityManager->persist($scientist);
        $this->entityManager->flush();
    }
}
