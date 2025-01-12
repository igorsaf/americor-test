<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250112131415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE loan_approved_requests (
                id UUID NOT NULL, 
                client_id UUID NOT NULL, 
                loan_product_id UUID NOT NULL, 
                loan_product_name VARCHAR(255) NOT NULL, 
                loan_product_term INT NOT NULL, 
                loan_product_interest_rate INT NOT NULL, 
                loan_product_amount BIGINT NOT NULL, 
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                PRIMARY KEY(id)
            )
        ');

        $this->addSql('COMMENT ON COLUMN loan_approved_requests.id IS \'(DC2Type:loan_approved_request_id)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.client_id IS \'(DC2Type:client_id)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.loan_product_id IS \'(DC2Type:loan_product_id)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.loan_product_name IS \'(DC2Type:loan_product_name)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.loan_product_term IS \'(DC2Type:loan_product_term)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.loan_product_interest_rate IS \'(DC2Type:loan_product_interest_rate)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.loan_product_amount IS \'(DC2Type:loan_product_amount)\'');
        $this->addSql('COMMENT ON COLUMN loan_approved_requests.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE loan_approved_requests');
    }
}
