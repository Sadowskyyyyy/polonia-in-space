<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\ExpeditionEntity;
use App\Entity\MarsScientistEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class ExpeditionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marsScientist = new MarsScientistEntity(
            1, 'Test', 'Test', 'pass',
            false, false, '',
            null, new ArrayCollection(), $marsStation,
            new ArrayCollection());

        $manager->persist(
            new ExpeditionEntity(1, $marsScientist, null, null, false, true)
        );
        $manager->flush();
    }
}
