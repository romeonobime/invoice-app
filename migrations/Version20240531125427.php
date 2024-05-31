<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531125427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE street street VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE post_code post_code VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE payment_due payment_due DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE client_name client_name VARCHAR(255) DEFAULT NULL, CHANGE client_email client_email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE street street VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL, CHANGE post_code post_code VARCHAR(255) NOT NULL, CHANGE country country VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE payment_due payment_due DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE description description VARCHAR(255) NOT NULL, CHANGE client_name client_name VARCHAR(255) NOT NULL, CHANGE client_email client_email VARCHAR(255) NOT NULL');
    }
}
