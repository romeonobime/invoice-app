<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530163704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, payment_terms_id INT DEFAULT NULL, status_id INT DEFAULT NULL, sender_address_id INT DEFAULT NULL, client_address_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', payment_due DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description VARCHAR(255) NOT NULL, client_name VARCHAR(255) NOT NULL, client_email VARCHAR(255) NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_9065174413B26D4F (payment_terms_id), INDEX IDX_906517446BF700BD (status_id), UNIQUE INDEX UNIQ_90651744A133F1B8 (sender_address_id), UNIQUE INDEX UNIQ_9065174465E39234 (client_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_invoice_item (invoice_id INT NOT NULL, invoice_item_id INT NOT NULL, INDEX IDX_A219680F2989F1FD (invoice_id), INDEX IDX_A219680FE0B6648D (invoice_item_id), PRIMARY KEY(invoice_id, invoice_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_payment_terms (id INT AUTO_INCREMENT NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174413B26D4F FOREIGN KEY (payment_terms_id) REFERENCES invoice_payment_terms (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517446BF700BD FOREIGN KEY (status_id) REFERENCES invoice_status (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A133F1B8 FOREIGN KEY (sender_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174465E39234 FOREIGN KEY (client_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE invoice_invoice_item ADD CONSTRAINT FK_A219680F2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice_invoice_item ADD CONSTRAINT FK_A219680FE0B6648D FOREIGN KEY (invoice_item_id) REFERENCES invoice_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174413B26D4F');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517446BF700BD');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744A133F1B8');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174465E39234');
        $this->addSql('ALTER TABLE invoice_invoice_item DROP FOREIGN KEY FK_A219680F2989F1FD');
        $this->addSql('ALTER TABLE invoice_invoice_item DROP FOREIGN KEY FK_A219680FE0B6648D');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE invoice_payment_terms');
        $this->addSql('DROP TABLE invoice_status');
    }
}
