<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191228004808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E7A45358C');
        //$this->addSql('DROP INDEX IDX_D8F0A91E7A45358C ON trick');
        $this->addSql('ALTER TABLE trick CHANGE date_add date_add DATETIME DEFAULT NULL, CHANGE date_update date_update DATETIME DEFAULT NULL, CHANGE groupe_id group_id INT DEFAULT NULL, CHANGE is_valid valid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EFE54D947 FOREIGN KEY (group_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EFE54D947 ON trick (group_id)');
        $this->addSql('ALTER TABLE comment CHANGE date_add date_add DATETIME DEFAULT NULL, CHANGE is_valid valid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE groupe CHANGE date_add date_add DATETIME DEFAULT NULL, CHANGE date_upd date_upd DATETIME DEFAULT NULL, CHANGE is_valid valid TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE date_add date_add VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE valid is_valid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE groupe CHANGE date_add date_add VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_upd date_upd VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE valid is_valid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EFE54D947');
        $this->addSql('DROP INDEX IDX_D8F0A91EFE54D947 ON trick');
        $this->addSql('ALTER TABLE trick CHANGE date_add date_add VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_update date_update VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE group_id groupe_id INT DEFAULT NULL, CHANGE valid is_valid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E7A45358C ON trick (groupe_id)');
    }
}
