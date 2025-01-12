<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventHandler;

use App\Shared\Application\Event\AbstractEmailNotification;
use App\Shared\Application\Event\AbstractSmsNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SmsNotificationHandler
{
    public function __invoke(AbstractSmsNotification $notification): void
    {
        echo 'New sms sending: ' . PHP_EOL;
        echo sprintf('Phone: %s', $notification->phone) . PHP_EOL;
        echo sprintf('Message: %s', $notification->message) . PHP_EOL;
    }
}