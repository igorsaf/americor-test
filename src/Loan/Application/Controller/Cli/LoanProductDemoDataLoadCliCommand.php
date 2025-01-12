<?php

declare(strict_types=1);

namespace App\Loan\Application\Controller\Cli;

use App\Loan\Domain\Entity\LoanProduct;
use App\Loan\Domain\Entity\LoanProduct\LoanProductAmount;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Loan\Domain\Entity\LoanProduct\LoanProductInterestRate;
use App\Loan\Domain\Entity\LoanProduct\LoanProductName;
use App\Loan\Domain\Entity\LoanProduct\LoanProductTerm;
use App\Loan\Domain\Repository\LoanProductRepositoryInterface;
use DateTimeImmutable;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:loan-product-demo-data-load',
    description: 'Loading demo loan product'
)]
final class LoanProductDemoDataLoadCliCommand extends Command
{
    public function __construct(
        private readonly LoanProductRepositoryInterface $loanProductRepository
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $loanProductId = LoanProductId::fromString('c2948333-c7f2-48bf-b8c5-414f52f9404f');

        if ($this->loanProductRepository->findById($loanProductId) !== null) {
            $output->writeln('<error>Demo loan product already exists</error>');

            return Command::FAILURE;
        }

        $loanProduct = new LoanProduct(
            $loanProductId,
            LoanProductName::fromString('Demo loan product'),
            LoanProductTerm::fromInt(365),
            LoanProductInterestRate::fromPercentage(12.34),
            LoanProductAmount::fromAmount(5678.90),
            new DateTimeImmutable()
        );

        $this->loanProductRepository->save($loanProduct);

        $output->writeln('<info>Demo loan product successfully loaded</info>');

        return Command::SUCCESS;
    }
}