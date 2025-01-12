<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Repository;

use App\Loan\Domain\Entity\LoanProduct;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Loan\Domain\Repository\LoanProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class LoanProductRepositoryDoctrine implements LoanProductRepositoryInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(LoanProduct $loanProduct): void
    {
        $this->entityManager->persist($loanProduct);
        $this->entityManager->flush();
    }


    public function findById(LoanProductId $id): ?LoanProduct
    {
        return $this->entityManager->getRepository(LoanProduct::class)->find($id);
    }
}