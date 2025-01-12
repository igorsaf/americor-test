<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service;

use App\Client\Domain\Entity\Client;
use App\Loan\Domain\Entity\ClientMonthlyIncome;
use App\Loan\Domain\Exception\LoanProductNotEligibleException;
use App\Loan\Domain\Service\LoanProductEligibilityRule\ClientAddressStateAllowedRule;
use App\Loan\Domain\Service\LoanProductEligibilityRule\ClientAddressStateNYRandomlyRejectedRule;
use App\Loan\Domain\Service\LoanProductEligibilityRule\ClientAgeRule;
use App\Loan\Domain\Service\LoanProductEligibilityRule\ClientFicoRatingRule;
use App\Loan\Domain\Service\LoanProductEligibilityRule\ClientMonthlyIncomeRule;
use App\Loan\Domain\Service\LoanProductEligibilityRule\LoanProductEligibilityRuleInterface;
use DateTimeImmutable;

final readonly class LoanProductEligibilityService
{
    /**
     * @param RandomRejectionServiceInterface $randomRejectionService
     */
    public function __construct(
        private RandomRejectionServiceInterface $randomRejectionService
    ) {
    }

    /**
     * @throws LoanProductNotEligibleException
     */
    public function eligibleOrThrow(
        Client $client,
        ClientMonthlyIncome $clientMonthlyIncomeInCents,
        DateTimeImmutable $requestDate,
    ): void {

        $eligibilityRules = [
            new ClientFicoRatingRule($client->getFicoRating()),
            new ClientMonthlyIncomeRule($clientMonthlyIncomeInCents),
            new ClientAgeRule($client->getBirthDate(), $requestDate),
            new ClientAddressStateAllowedRule($client->getAddress()->getState()),
            new ClientAddressStateNYRandomlyRejectedRule($client->getAddress()->getState(), $this->randomRejectionService)
        ];

        /** @var LoanProductEligibilityRuleInterface $eligibilityRule */
        foreach ($eligibilityRules as $eligibilityRule) {
            if (!$eligibilityRule->isValid()) {
                throw new LoanProductNotEligibleException($eligibilityRule->failedMessage());
            }
        }
    }
}