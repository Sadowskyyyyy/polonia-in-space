<?php
declare(strict_types=1);

namespace App\UI\Rest\Response;

use Symfony\Component\HttpFoundation\Response;

class ApiResponse extends Response
{
    public function isInvalid(): bool
    {
        return false;
    }
}
