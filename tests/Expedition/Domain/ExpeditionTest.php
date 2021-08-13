<?php

declare(strict_types=1);

namespace App\Tests\Expedition\Domain;


use App\DomainModel\Expedition;
use App\DomainModel\MarsScientist;
use App\Exception\CannotFinishExpeditionWhichHasNotStartedYetException;
use App\Exception\CannotStartFinishedExpeditionException;
use App\Exception\CannotStartStartedExpeditionException;
use PHPUnit\Framework\TestCase;

class ExpeditionTest extends TestCase
{
    private Expedition $expedition;

    public function testTryToFinishExpeditionAndRunSuccessful()
    {
        $marsScientist = new MarsScientist(
            1, 'Adam', 'Jensen', '', array(), array(), array()
        );
        $expedition = new Expedition(1, $marsScientist, false, true);
        $expedition->finishExpedition();

        $this->assertSame(true, $expedition->isFinished());
    }

    public function testTryToFinishFinishedExpeditionAndThrowError()
    {
        $this->expectException(CannotFinishExpeditionWhichHasNotStartedYetException::class);
        $marsScientist = new MarsScientist(
            1, 'Adam', 'Jensen', '', array(), array(), array()
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->finishExpedition();
    }

    public function testTryToStartFinishedExpeditionAndThrowError()
    {
        $this->expectException(CannotStartFinishedExpeditionException::class);
        $marsScientist = new MarsScientist(
            1, 'Adam', 'Jensen', '', array(), array(), array()
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->startExpedition();
    }

    public function testTryToStartStartedExpeditionAndThrowError()
    {
        $this->expectException(CannotStartStartedExpeditionException::class);
        $marsScientist = new MarsScientist(
            1, 'Adam', 'Jensen', '', array(), array(), array()
        );
        $expedition = new Expedition(1, $marsScientist, false, true);
        $expedition->startExpedition();
    }

    public function testTryToGenerateExpeditionConclusionAndRunSucessful()
    {
        $marsScientist = new MarsScientist(
            1, 'Adam', 'Jensen', '', array(), array(), array()
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->setStartDate((string)null);
        $expedition->generateExpeditionConclusion();
    }
}