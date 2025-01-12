<?php

declare(strict_types=1);

namespace App\Loan\Application\Service;

use App\Loan\Domain\Entity\Loan;
use App\Loan\Domain\Entity\LoanApprovedRequest;
use App\Loan\Domain\Service\LoanIssueService;
use App\Loan\Domain\Service\LoanIssueServiceInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class EventPublishingLoanIssueService implements LoanIssueServiceInterface
{
    public function __construct(
        private LoanIssueServiceInterface $inner,
        private MessageBusInterface $eventBus
    ) {
    }

    public function issueForApprovedRequest(LoanApprovedRequest $approvedRequest): Loan
    {
        $loan = $this->inner->issueForApprovedRequest($approvedRequest);

        foreach ($loan->releaseEvents() as $event) {
            $this->eventBus->dispatch($event);
        }

        return $loan;
    }
}