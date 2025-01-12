<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Repository;

use App\Loan\Domain\Entity\Loan;
use App\Loan\Domain\Entity\Loan\LoanId;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Loan\Domain\Repository\LoanRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class LoanRepositoryDoctrine implements LoanRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(Loan $loan): void
    {
        $this->entityManager->persist($loan);
        $this->entityManager->flush();
    }

    public function findById(LoanId $id): ?Loan
    {
        return $this->entityManager->getRepository(Loan::class)->find($id);
    }

    public function findByApprovedRequestId(LoanApprovedRequestId $id): ?Loan
    {
        return $this->entityManager->getRepository(Loan::class)->findOneBy(['approvedRequestId' => $id]);
    }
}