<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Repository;

use App\Loan\Domain\Entity\LoanApprovedRequest;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Loan\Domain\Repository\LoanApprovedRequestRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class LoanApprovedRequestRepositoryDoctrine implements LoanApprovedRequestRepositoryInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function save(LoanApprovedRequest $loanApprovedRequest): void
    {
        $this->entityManager->persist($loanApprovedRequest);
        $this->entityManager->flush();
    }

    public function findById(LoanApprovedRequestId $id): ?LoanApprovedRequest
    {
        return $this->entityManager->getRepository(LoanApprovedRequest::class)->find($id);
    }
}