<?php
declare(strict_types=1);

namespace App\Tests\Scientist\Domain\MarsScientist;

use App\DomainModel\Expedition;
use App\DomainModel\MarsScientist;
use App\Exception\CannotAddStartedOrFinishedExpeditionException;
use App\Exception\ExpeditionIsNotAlreadyFinishedException;
use App\Exception\ScientistIsAliveException;
use PHPUnit\Framework\TestCase;
use function count;
class MarsScientistTest extends TestCase
{
    private MarsScientist $scientist;

    /** @test */
    public function testCreatingNewScientist()
    {
        $newScientist = MarsScientist::createNewScientist('Adam', 'Jensen');
        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            ['test'],
            ['test'],
            ['test']
        );
        $this->assertSame($scientist->getApikey(), $newScientist->getApikey());
    }

    /** @test */
    public function testMarkingAsMissing()
    {
        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            ['test'],
            ['test'],
            ['test']
        );
        $scientist->markAsMissing();

        $this->assertTrue($scientist->isMissing());
    }

    /** @test */
    public function testMarkingAsDead()
    {
        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            ['test'],
            ['test'],
            ['test']
        );
        $scientist->markAsDead();

        $this->assertTrue($scientist->isDead());
    }

    /** @test */
    public function testTryToGiveReasonOfDeathToLivingScientist()
    {
        $this->expectException(ScientistIsAliveException::class);
        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            ['test'],
            ['test'],
            ['test']
        );

        $scientist->markAsAlive();
        $scientist->setReasonOfDeath('Heart attack');
    }

    /** @test */
    public function testTryToGiveReasonOfDeathToDeadScientist()
    {
        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            ['test'],
            ['test'],
            ['test']
        );

        $scientist->markAsDead();
        $scientist->setReasonOfDeath('Heart attack');

       $this->assertTrue($scientist->isDead());
    }

    /** @test */
    public function testTryToAddFinishedExpeditionSuccessful()
    {
        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            [],
            [],
            []
        );
        $expedition = new Expedition(
            1,
            $scientist,
            true,
            true
        );

        $scientist->addFinishedExpedition($expedition);
        $this->assertEquals(1, count($scientist->getFinishedExpeditions()));
    }

    /** @test */
    public function testTryToAddFinishedExpeditionAndThrowError()
    {
        $this->expectException(ExpeditionIsNotAlreadyFinishedException::class);

        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            [],
            [],
            []
        );
        $expedition = new Expedition(
            1,
            $scientist,
            false,
            true
        );

        $scientist->addFinishedExpedition($expedition);
    }

    /** @test */
    public function testTryToAddPlannedExpeditionSuccessful()
    {

        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            [],
            [],
            []
        );
        $expedition = new Expedition(
            1,
            $scientist,
            false,
            false
        );

        $scientist->addPlanedExpedition($expedition);
        $this->assertEquals(1, count($scientist->getPlannedExpeditions()));

    }

    /** @test */
    public function testTryToAddRunningExpeditionToPlannedExpeditionAndThrowError()
    {
        $this->expectException(CannotAddStartedOrFinishedExpeditionException::class);

        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            [],
            [],
            []
        );
        $expedition = new Expedition(
            1,
            $scientist,
            false,
            true
        );

        $scientist->addPlanedExpedition($expedition);
    }

    /** @test */
    public function testTryToAddFinishedExpeditionToPlannedExpeditionAndThrowError()
    {
        $this->expectException(CannotAddStartedOrFinishedExpeditionException::class);

        $scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            [],
            [],
            []
        );
        $expedition = new Expedition(
            1,
            $scientist,
            true,
            true
        );

        $scientist->addPlanedExpedition($expedition);
    }
}
