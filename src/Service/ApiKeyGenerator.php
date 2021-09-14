<?php
declare(strict_types=1);

namespace App\Service;

use function uniqid;

class ApiKeyGenerator
{
    const LENGTH = 30;

    public function generateApiKey(): string
    {
        return substr(uniqid(), 0, self::LENGTH);
    }
}
