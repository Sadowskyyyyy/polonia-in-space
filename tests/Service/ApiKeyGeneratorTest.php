<?php

namespace App\Tests\Service;

use App\Service\ApiKeyGenerator;
use PHPUnit\Framework\TestCase;
use function strlen;

class ApiKeyGeneratorTest extends TestCase
{
    public function test_should_count_30()
    {
        $generator = new ApiKeyGenerator();

        $this->assertEquals(30, strlen($generator->generateApiKey()));
    }
}