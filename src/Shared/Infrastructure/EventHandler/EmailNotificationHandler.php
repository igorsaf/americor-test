<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventHandler;

use App\Shared\Application\Event\AbstractEmailNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class EmailNotificationHandler
{
    public function __invoke(AbstractEmailNotification $notification): void
    {
        echo 'New email sending: ' . PHP_EOL;
        echo sprintf('To: %s', $notification->to) . PHP_EOL;
        echo sprintf('Subject: %s', $notification->subject) . PHP_EOL;
        echo sprintf('Message: %s', $notification->message) . PHP_EOL;
    }
}