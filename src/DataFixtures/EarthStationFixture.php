<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\EarthResarchStation;
use App\Entity\EarthScientistEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EarthStationFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $earthScientist = new EarthScientistEntity(
            1, 'Test', 'Test',
            '', null);

        $earthStation = new EarthResarchStation(1, new ArrayCollection(), true);
        $earthStation->addScientist($earthScientist);

        $manager->persist($earthStation);
        $manager->flush();
    }
}
