<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250112103129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE clients (
                id UUID NOT NULL, 
                last_name VARCHAR(255) NOT NULL, 
                first_name VARCHAR(255) NOT NULL, 
                birth_date DATE NOT NULL, 
                ssn VARCHAR(11) NOT NULL, 
                fico_rating SMALLINT NOT NULL, 
                email VARCHAR(255) NOT NULL, 
                phone VARCHAR(17) NOT NULL, 
                address_street VARCHAR(255) NOT NULL, 
                address_city VARCHAR(255) NOT NULL, 
                address_state VARCHAR(2) NOT NULL, 
                address_zip VARCHAR(10) NOT NULL, 
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                PRIMARY KEY(id)
           )
       ');

        $this->addSql('CREATE UNIQUE INDEX uniq_clients_phone ON clients (phone)');
        $this->addSql('CREATE UNIQUE INDEX uniq_clients_email ON clients (email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_clients_ssn ON clients (ssn)');

        $this->addSql('COMMENT ON COLUMN clients.id IS \'(DC2Type:client_id)\'');
        $this->addSql('COMMENT ON COLUMN clients.last_name IS \'(DC2Type:client_last_name)\'');
        $this->addSql('COMMENT ON COLUMN clients.first_name IS \'(DC2Type:client_first_name)\'');
        $this->addSql('COMMENT ON COLUMN clients.birth_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN clients.ssn IS \'(DC2Type:client_ssn)\'');
        $this->addSql('COMMENT ON COLUMN clients.fico_rating IS \'(DC2Type:client_fico_rating)\'');
        $this->addSql('COMMENT ON COLUMN clients.email IS \'(DC2Type:client_email)\'');
        $this->addSql('COMMENT ON COLUMN clients.phone IS \'(DC2Type:client_phone)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_street IS \'(DC2Type:client_address_street)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_city IS \'(DC2Type:client_address_city)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_state IS \'(DC2Type:client_address_state)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_zip IS \'(DC2Type:client_address_zip)\'');
        $this->addSql('COMMENT ON COLUMN clients.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN clients.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE clients');
    }
}
