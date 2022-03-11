<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311064735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, unit VARCHAR(100) NOT NULL, unit_code VARCHAR(10) NOT NULL, created_at DATETIME NOT NULL, unit_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee ADD unit_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1F476E05C FOREIGN KEY (unit_id_id) REFERENCES unit (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1F476E05C ON employee (unit_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1F476E05C');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP INDEX UNIQ_5D9F75A1F476E05C ON employee');
        $this->addSql('ALTER TABLE employee DROP unit_id_id');
    }
}
