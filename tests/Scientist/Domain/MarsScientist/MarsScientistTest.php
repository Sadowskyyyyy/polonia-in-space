<?php
declare(strict_types=1);

namespace App\Tests\Scientist\Domain\MarsScientist;

use App\DomainModel\MarsScientist;
use App\Exception\ScientistIsAliveException;
use PHPUnit\Framework\TestCase;

class MarsScientistTest extends TestCase
{
    private MarsScientist $scientist;

    protected function setUp(): void
    {
        $this->scientist = new MarsScientist(
            (int) null,
            'Adam',
            'Jensen',
            (string) null,
            ['test'],
            ['test'],
            ['test']
        );
    }

    /** @test */
    public function test_creating_new_scientist(): void
    {
        $newScientist = MarsScientist::createNewScientist('Adam', 'Jensen');

        $this->assertSame($this->scientist->getApikey(), $newScientist->getApikey());
    }

    /** @test */
    public function test_marking_as_missing(): void
    {
        $this->scientist->markAsMissing();

        $this->assertTrue($this->scientist->isMissing());
    }

    /** @test */
    public function test_marking_as_dead(): void
    {
        $this->scientist->markAsDead();

        $this->assertTrue($this->scientist->isDead());
    }

    /** @test */
    public function test_try_to_give_eason_of_death_to_living_scientist(): void
    {
        $this->expectException(ScientistIsAliveException::class);

        $this->scientist->markAsAlive();
        $this->scientist->setReasonOfDeath('Heart attack');
    }

    /** @test */
    public function test_try_to_give_reason_of_death_to_dead_scientist(): void
    {
        $this->scientist->markAsDead();
        $this->scientist->setReasonOfDeath('Heart attack');

        $this->assertTrue($this->scientist->isDead());
    }
}
