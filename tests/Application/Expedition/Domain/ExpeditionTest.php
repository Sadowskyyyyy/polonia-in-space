<?php

declare(strict_types=1);

namespace App\Tests\Application\Expedition\Domain;

use App\Application\Expedition\Domain\Exception\CannotFinishExpeditionWhichHasNotStartedYetException;
use App\Application\Expedition\Domain\Exception\CannotStartFinishedExpeditionException;
use App\Application\Expedition\Domain\Exception\CannotStartStartedExpeditionException;
use App\Application\Expedition\Domain\Expedition;
use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
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
        $dateTime = new \DateTime();
        $marsScientist = new MarsScientist(
            1, 'Adam', 'Jensen', '', array(), array(), array()
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->setStartDate((string)null);
        $conclusion = $expedition->generateExpeditionConclusion();

    }
}