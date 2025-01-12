<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service;

use App\Client\Domain\Entity\Client;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;
use App\Loan\Domain\Entity\LoanProduct;
use App\Loan\Domain\Entity\LoanProduct\LoanProductInterestRate;

final class LoanApprovedRequestInterestRateCalculator
{
    private const int CA_CLIENTS_INTEREST_RATE_COEFFICIENT_IN_BASIS_POINTS = 1149;

    public function calculateForClientAndLoanProduct(Client $client, LoanProduct $loanProduct): LoanProductInterestRate
    {
        $caState = ClientAddressState::fromString('CA');

        if (!$client->getAddress()->getState()->isInList([$caState])) {
            return $loanProduct->interestRate;
        }

        return $loanProduct->interestRate->add(
            LoanProductInterestRate::fromBasisPoints(self::CA_CLIENTS_INTEREST_RATE_COEFFICIENT_IN_BASIS_POINTS)
        );
    }

}