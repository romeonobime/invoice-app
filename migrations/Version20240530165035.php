<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530165035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_invoice_item DROP FOREIGN KEY FK_A219680F2989F1FD');
        $this->addSql('ALTER TABLE invoice_invoice_item DROP FOREIGN KEY FK_A219680FE0B6648D');
        $this->addSql('DROP TABLE invoice_invoice_item');
        $this->addSql('ALTER TABLE invoice_item ADD invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice_invoice_item (invoice_id INT NOT NULL, invoice_item_id INT NOT NULL, INDEX IDX_A219680FE0B6648D (invoice_item_id), INDEX IDX_A219680F2989F1FD (invoice_id), PRIMARY KEY(invoice_id, invoice_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE invoice_invoice_item ADD CONSTRAINT FK_A219680F2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice_invoice_item ADD CONSTRAINT FK_A219680FE0B6648D FOREIGN KEY (invoice_item_id) REFERENCES invoice_item (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477B2989F1FD');
        $this->addSql('DROP INDEX IDX_1DDE477B2989F1FD ON invoice_item');
        $this->addSql('ALTER TABLE invoice_item DROP invoice_id');
    }
}
