<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\RegisterScientistCommand;
use App\DomainModel\AbstractScientist;
use App\Entity\EarthScientist;
use App\Entity\MarsScientistEntity;
use App\Entity\SpaceScientist;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class ScientistFactory
{
    public const EARTH_SCIENTIST = 'earthstation';
    public const SPACE_SCIENTIST = 'spacestation';
    public const MARS_SCIENTIST = 'marsstation';

    private ResarchStationRepositoryInterface $researchStationRepository;
    private ApiKeyGenerator $apiKeyGenerator;
    private EntityManagerInterface $entityManager;

    public function __construct(ResarchStationRepositoryInterface $researchStationRepository, ApiKeyGenerator $apiKeyGenerator, EntityManagerInterface $entityManager)
    {
        $this->researchStationRepository = $researchStationRepository;
        $this->apiKeyGenerator = $apiKeyGenerator;
        $this->entityManager = $entityManager;
    }

    public function createFromCommand(RegisterScientistCommand $command): EarthScientist|SpaceScientist|MarsScientistEntity
    {
        $station = $this->researchStationRepository->getResarchStationEntityByName($command->station);
        $apikey = $this->apiKeyGenerator->generateApiKey();

        /** @var AbstractScientist $scientist */
        $scientist = match ($command->station) {
            self::EARTH_SCIENTIST => new EarthScientist(
                $command->name,
                $command->surname,
                $station,
                new User($command->name, ['ROLE_EARTH_SCIENTIST'], $apikey),
                $apikey
            ),
            self::SPACE_SCIENTIST => new SpaceScientist(
                $command->name,
                $command->surname,
                $station,
                new User($command->name, ['ROLE_SPACE_SCIENTIST'], $apikey),
                $apikey
            ),
            self::MARS_SCIENTIST => new MarsScientistEntity(
                $command->name,
                $command->surname,
                $apikey,
                false,
                false,
                null,
                null,
                $station,
                new ArrayCollection(),
                new ArrayCollection(),
                new User($command->name, ['ROLE_MARS_SCIENTIST'], $apikey),
            ),
        };

        return $scientist;
    }
}
