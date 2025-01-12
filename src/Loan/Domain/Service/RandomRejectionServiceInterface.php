<?php

declare(strict_types=1);


namespace App\Loan\Domain\Service;

interface RandomRejectionServiceInterface
{
    public function shouldReject(float $rejectionProbability): bool;
}