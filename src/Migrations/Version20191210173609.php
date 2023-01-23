<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210173609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick CHANGE date_add date_add VARCHAR(255) DEFAULT NULL, CHANGE date_update date_update VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD trick_id INT NOT NULL, ADD comment LONGTEXT NOT NULL, ADD is_valid TINYINT(1) NOT NULL, ADD date_add VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_9474526CB281BE2E ON comment (trick_id)');
        $this->addSql('ALTER TABLE group_trick CHANGE date_add date_add VARCHAR(255) DEFAULT NULL, CHANGE date_upd date_upd VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB281BE2E');
        $this->addSql('DROP INDEX IDX_9474526CB281BE2E ON comment');
        $this->addSql('ALTER TABLE comment DROP trick_id, DROP comment, DROP is_valid, DROP date_add');
        $this->addSql('ALTER TABLE group_trick CHANGE date_add date_add DATETIME DEFAULT NULL, CHANGE date_upd date_upd DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE trick CHANGE date_add date_add DATETIME DEFAULT NULL, CHANGE date_update date_update DATETIME DEFAULT NULL');
    }
}
