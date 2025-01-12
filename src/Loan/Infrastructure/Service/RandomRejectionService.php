<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Service;

use App\Loan\Domain\Service\RandomRejectionServiceInterface;

final class RandomRejectionService implements RandomRejectionServiceInterface
{
    public function shouldReject(float $rejectionProbability): bool
    {
        return mt_rand(0,100) / 100 < $rejectionProbability;
    }
}