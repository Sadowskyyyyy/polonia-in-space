<?php
declare(strict_types=1);

namespace App\Service;

use function random_bytes;

class ApiKeyGenerator
{
    public function generateApiKey(): string
    {
        return random_bytes(30);
    }
}
