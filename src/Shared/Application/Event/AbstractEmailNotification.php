<?php

declare(strict_types=1);


namespace App\Shared\Application\Event;

abstract readonly class AbstractEmailNotification
{
    final public function __construct(
        public string $to,
        public string $subject,
        public string $message
    )
    {
    }
}