<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250112195559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE loans (
                id UUID NOT NULL, 
                client_id UUID NOT NULL, 
                product_id UUID NOT NULL, 
                approved_request_id UUID NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                term INT NOT NULL, 
                interest_rate INT NOT NULL, 
                amount BIGINT NOT NULL, 
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                PRIMARY KEY(id)
            )
        ');

        $this->addSql('CREATE UNIQUE INDEX uniq_loans_loan_approved_request_id ON loans (approved_request_id)');

        $this->addSql('COMMENT ON COLUMN loans.id IS \'(DC2Type:loan_id)\'');
        $this->addSql('COMMENT ON COLUMN loans.client_id IS \'(DC2Type:client_id)\'');
        $this->addSql('COMMENT ON COLUMN loans.product_id IS \'(DC2Type:loan_product_id)\'');
        $this->addSql('COMMENT ON COLUMN loans.approved_request_id IS \'(DC2Type:loan_approved_request_id)\'');
        $this->addSql('COMMENT ON COLUMN loans.name IS \'(DC2Type:loan_name)\'');
        $this->addSql('COMMENT ON COLUMN loans.term IS \'(DC2Type:loan_term)\'');
        $this->addSql('COMMENT ON COLUMN loans.interest_rate IS \'(DC2Type:loan_interest_rate)\'');
        $this->addSql('COMMENT ON COLUMN loans.amount IS \'(DC2Type:loan_amount)\'');
        $this->addSql('COMMENT ON COLUMN loans.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE loans');
    }
}
