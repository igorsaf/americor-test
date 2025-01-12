<?php

declare(strict_types=1);

namespace App\Loan\Domain\Entity;

use App\Client\Domain\Entity\Client\ClientId;
use App\Loan\Domain\Entity\Loan\LoanAmount;
use App\Loan\Domain\Entity\Loan\LoanId;
use App\Loan\Domain\Entity\Loan\LoanInterestRate;
use App\Loan\Domain\Entity\Loan\LoanName;
use App\Loan\Domain\Entity\Loan\LoanTerm;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Loan\Domain\Event\LoanIssuedEvent;
use DateTimeImmutable;

final class Loan
{
    /** @var LoanIssuedEvent[]  */
    private array $recordedEvents = [];

    public function __construct(
        public LoanId $id,
        public ClientId $clientId,
        public LoanProductId $productId,
        public LoanApprovedRequestId $approvedRequestId,
        public LoanName $name,
        public LoanTerm $term,
        public LoanInterestRate $interestRate,
        public LoanAmount $amount,
        public DateTimeImmutable $createdAt
    ) {
        $this->recordedEvents[] = new LoanIssuedEvent($id);
    }

    public static function fromApprovedRequestAndTime(
        LoanApprovedRequest $approvedRequest,
        DateTimeImmutable $time
    ): self {
        return new self(
            LoanId::next(),
            $approvedRequest->clientId,
            $approvedRequest->loanProductId,
            $approvedRequest->id,
            LoanName::fromString((string)$approvedRequest->loanProductName),
            LoanTerm::fromInt($approvedRequest->loanProductTerm->value()),
            LoanInterestRate::fromBasisPoints($approvedRequest->loanProductInterestRate->toBasisPoints()),
            LoanAmount::fromCents($approvedRequest->loanProductAmount->toCents()),
            $time
        );
    }

    /**
     * @return LoanIssuedEvent[]
     */
    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }
}