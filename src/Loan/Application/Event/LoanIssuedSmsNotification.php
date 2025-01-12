<?php

declare(strict_types=1);

namespace App\Loan\Application\Event;

use App\Client\Domain\Entity\Client;
use App\Loan\Domain\Entity\Loan;
use App\Shared\Application\Event\AbstractSmsNotification;

final readonly class LoanIssuedSmsNotification extends AbstractSmsNotification
{
    private const string MESSAGE_TPL = 'New loan issued sms message';

    public static function make(Client $client, Loan $loan): self
    {
        return new self(
            $client->getPhone()->value(),
            self::MESSAGE_TPL,
        );
    }
}