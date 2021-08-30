<?php

namespace App\Tests\Service;

use App\Service\ApiKeyGenerator;
use PHPUnit\Framework\TestCase;
use function strlen;

class ApiKeyGeneratorTest extends TestCase
{
    private ApiKeyGenerator $generator;

    protected function setUp(): void
    {
        $generator = new ApiKeyGenerator();
    }

    public function test_should_count_30()
    {
        $generator = new ApiKeyGenerator();

        $this->assertEquals(30, strlen($generator->generateApiKey()));
    }
}
