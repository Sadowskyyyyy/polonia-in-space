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

    /** @test */
    public function test_try_to_finish_expedition_and_run_successful()
    {
        $marsScientist = new MarsScientist(
            1,
            'Adam',
            'Jensen',
            '',
            [],
            [],
            []
        );
        $expedition = new Expedition(1, $marsScientist, false, true);
        $expedition->finish();

        $this->assertTrue($expedition->isFinished());
    }

    /** @test */
    public function test_try_to_finish_finished_expedition_and_throw_error()
    {
        $this->expectException(CannotFinishExpeditionWhichHasNotStartedYetException::class);
        $marsScientist = new MarsScientist(
            1,
            'Adam',
            'Jensen',
            '',
            [],
            [],
            []
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->finish();
    }

    /** @test */
    public function test_try_to_start_finished_expedition_and_throw_error()
    {
        $this->expectException(CannotStartFinishedExpeditionException::class);
        $marsScientist = new MarsScientist(
            1,
            'Adam',
            'Jensen',
            '',
            [],
            [],
            []
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->start();
    }

    /** @test */
    public function test_try_to_start_started_expedition_and_throw_error()
    {
        $this->expectException(CannotStartStartedExpeditionException::class);
        $marsScientist = new MarsScientist(
            1,
            'Adam',
            'Jensen',
            '',
            [],
            [],
            []
        );
        $expedition = new Expedition(1, $marsScientist, false, true);
        $expedition->start();
    }

    /** @test */
    public function test_try_to_generate_expedition_conclusion_and_run_sucessful()
    {
        $marsScientist = new MarsScientist(
            1,
            'Adam',
            'Jensen',
            '',
            [],
            [],
            []
        );
        $expedition = new Expedition(1, $marsScientist, true, false);
        $expedition->setStartDate((string)null);
        $expedition->generateExpeditionConclusion();
    }
}
