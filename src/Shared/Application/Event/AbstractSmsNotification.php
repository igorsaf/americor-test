<?php

declare(strict_types=1);


namespace App\Shared\Application\Event;

abstract readonly class AbstractSmsNotification
{
    final public function __construct(
        public string $phone,
        public string $message
    )
    {

    }
}