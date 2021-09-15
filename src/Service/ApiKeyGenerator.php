<?php
declare(strict_types=1);

namespace App\Service;

use function base64_encode;
use function random_bytes;
use function strtr;
use function substr;

class ApiKeyGenerator
{
    public const LENGTH = 30;

    public function generateApiKey(): string
    {
        $bytes = random_bytes(self::LENGTH);

        return substr(strtr(base64_encode($bytes), '+/', '-_'), 0, self::LENGTH);
    }
}
