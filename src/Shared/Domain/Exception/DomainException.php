<?php

declare(strict_types=1);


namespace App\Shared\Domain\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

abstract class DomainException extends Exception
{
}