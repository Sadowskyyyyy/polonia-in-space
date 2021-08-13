<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\SpaceResearchStationEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class SpaceStationFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $spaceStation = new SpaceResearchStationEntity(
            1,
            new ArrayCollection(),
            false,
            99.99,
            200,
            1000000,
            2500,
            82.2,
            5.5
        );

        $manager->persist($spaceStation);
        $manager->flush();
    }
}
