<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250112112035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE loan_products (
                id UUID NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                term INT NOT NULL, 
                interest_rate INT NOT NULL, 
                amount BIGINT NOT NULL, 
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                PRIMARY KEY(id)
            )
        ');

        $this->addSql('COMMENT ON COLUMN loan_products.id IS \'(DC2Type:loan_product_id)\'');
        $this->addSql('COMMENT ON COLUMN loan_products.name IS \'(DC2Type:loan_product_name)\'');
        $this->addSql('COMMENT ON COLUMN loan_products.term IS \'(DC2Type:loan_product_term)\'');
        $this->addSql('COMMENT ON COLUMN loan_products.interest_rate IS \'(DC2Type:loan_product_interest_rate)\'');
        $this->addSql('COMMENT ON COLUMN loan_products.amount IS \'(DC2Type:loan_product_amount)\'');
        $this->addSql('COMMENT ON COLUMN loan_products.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE loan_products');
    }
}
