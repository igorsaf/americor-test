<?php

declare(strict_types=1);

namespace App\Loan\Application\Event;

use App\Client\Domain\Entity\Client;
use App\Loan\Domain\Entity\Loan;
use App\Shared\Application\Event\AbstractEmailNotification;

final readonly class LoanIssuedEmailNotification extends AbstractEmailNotification
{
    private const string SUBJECT_TPL = 'New loan issued email subject';
    private const string MESSAGE_TPL = 'New loan issued email message';

    public static function make(Client $client, Loan $loan): self
    {
        return new self(
            $client->getEmail()->value(),
            self::SUBJECT_TPL,
            self::MESSAGE_TPL
        );
    }
}