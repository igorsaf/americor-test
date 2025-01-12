<?php

declare(strict_types=1);

namespace App\Loan\Application\EventHandler;

use App\Client\Domain\Exception\ClientNotFoundException;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Loan\Application\Event\LoanIssuedEmailNotification;
use App\Loan\Application\Event\LoanIssuedSmsNotification;
use App\Loan\Domain\Event\LoanIssuedEvent;
use App\Loan\Domain\Exception\LoanNotFoundException;
use App\Loan\Domain\Repository\LoanRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final readonly class LoanIssuedEventHandler
{
    public function __construct(
        private LoanRepositoryInterface $loanRepository,
        private ClientRepositoryInterface $clientRepository,
        private MessageBusInterface $eventBus,
    ) {}

    public function __invoke(LoanIssuedEvent $event): void
    {
        $loan = $this->loanRepository->findById($event->loanId);
        if ($loan === null) {
            throw new LoanNotFoundException($event->loanId);
        }

        $client = $this->clientRepository->findById($loan->clientId);
        if ($client === null) {
            throw new ClientNotFoundException($loan->clientId);
        }

        $this->eventBus->dispatch(
            LoanIssuedEmailNotification::make($client, $loan)
        );

        $this->eventBus->dispatch(
            LoanIssuedSmsNotification::make($client, $loan)
        );
    }
}