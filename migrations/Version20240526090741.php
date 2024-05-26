<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526090741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, sender_address_id INT DEFAULT NULL, client_address_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', payment_due DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description VARCHAR(255) NOT NULL, payment_terms INT NOT NULL, client_name VARCHAR(255) NOT NULL, client_email VARCHAR(255) NOT NULL, total INT NOT NULL, UNIQUE INDEX UNIQ_906517446BF700BD (status_id), UNIQUE INDEX UNIQ_90651744A133F1B8 (sender_address_id), UNIQUE INDEX UNIQ_9065174465E39234 (client_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, price INT NOT NULL, total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517446BF700BD FOREIGN KEY (status_id) REFERENCES invoice_status (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A133F1B8 FOREIGN KEY (sender_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174465E39234 FOREIGN KEY (client_address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517446BF700BD');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744A133F1B8');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174465E39234');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE invoice_status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
