<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190128101129 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE223375BD21');
        $this->addSql('DROP INDEX IDX_8244BE223375BD21 ON film');
        $this->addSql('ALTER TABLE film CHANGE editeur_id editor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE226995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('CREATE INDEX IDX_8244BE226995AC4C ON film (editor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE226995AC4C');
        $this->addSql('DROP INDEX IDX_8244BE226995AC4C ON film');
        $this->addSql('ALTER TABLE film CHANGE editor_id editeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE223375BD21 FOREIGN KEY (editeur_id) REFERENCES editor (id)');
        $this->addSql('CREATE INDEX IDX_8244BE223375BD21 ON film (editeur_id)');
    }
}
