<?php
declare(strict_types=1);

namespace App\UI\Rest\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiResponse extends Response
{
    public function isInvalid(): bool
    {
        return false;
    }
}
