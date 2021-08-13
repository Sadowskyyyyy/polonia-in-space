<?php

declare(strict_types=1);

namespace App\Tests\Scientist\Domain\MarsScientist;


use App\DomainModel\Expedition;
use App\DomainModel\MarsScientist;
use App\Exception\CannotAddStartedOrFinishedExpeditionException;
use App\Exception\ExpeditionIsNotAlreadyFinishedException;
use App\Exception\ScientistIsAliveException;
use PHPUnit\Framework\TestCase;

class MarsScientistTest extends TestCase
{
    private MarsScientist $scientist;

    public function testCreatingNewScientist()
    {
        $newScientist = MarsScientist::createNewScientist('Adam', 'Jensen');
        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array('test'), array('test'), array('test')
        );
        //TODO make assertSame(object, object)
        $this->assertSame($scientist->getPassword(), $newScientist->getPassword());
    }

    public function testMarkingAsMissing()
    {
        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array('test'), array('test'), array('test')
        );
        $scientist->markAsMissing();

        $this->assertTrue($scientist->isMissing());
    }

    public function testMarkingAsDead()
    {
        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array('test'), array('test'), array('test')
        );
        $scientist->markAsDead();

        $this->assertTrue($scientist->isDead());
    }

    public function testTryToGiveReasonOfDeathToLivingScientist()
    {
        $this->expectException(ScientistIsAliveException::class);
        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array('test'), array('test'), array('test')
        );

        $scientist->markAsAlive();
        $scientist->setReasonOfDeath('Heart attack');
    }

    public function testTryToGiveReasonOfDeathToDeadScientist()
    {
        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array('test'), array('test'), array('test')
        );

        $scientist->markAsDead();
        $scientist->setReasonOfDeath('Heart attack');
    }

    public function testTryToAddFinishedExpeditionSuccessful()
    {
        $this->doesNotPerformAssertions();

        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array(), array(), array()
        );
        $expedition = new Expedition(
            1, $scientist, true, true
        );

        $scientist->addFinishedExpedition($expedition);
    }

    public function testTryToAddFinishedExpeditionAndThrowError()
    {
        $this->expectException(ExpeditionIsNotAlreadyFinishedException::class);

        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array(), array(), array()
        );
        $expedition = new Expedition(
            1, $scientist, false, true
        );

        $scientist->addFinishedExpedition($expedition);
    }

    public function testTryToAddPlannedExpeditionSuccessful()
    {
        $this->doesNotPerformAssertions();

        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array(), array(), array()
        );
        $expedition = new Expedition(
            1, $scientist, false, false
        );

        $scientist->addPlanedExpedition($expedition);
    }

    public function testTryToAddRunningExpeditionToPlannedExpeditionAndThrowError()
    {
        $this->expectException(CannotAddStartedOrFinishedExpeditionException::class);

        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array(), array(), array()
        );
        $expedition = new Expedition(
            1, $scientist, false, true
        );

        $scientist->addPlanedExpedition($expedition);
    }

    public function testTryToAddFinishedExpeditionToPlannedExpeditionAndThrowError()
    {
        $this->expectException(CannotAddStartedOrFinishedExpeditionException::class);

        $scientist = new MarsScientist(
            (int)null, 'Adam', 'Jensen',
            (string)null, array(), array(), array()
        );
        $expedition = new Expedition(
            1, $scientist, true, true
        );

        $scientist->addPlanedExpedition($expedition);
    }
}