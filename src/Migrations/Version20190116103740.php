<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116103740 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acteur (id INT NOT NULL, date_naissance DATE DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteur (id INT NOT NULL, date_naissance DATE DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_film (genre_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_39A967D24296D31F (genre_id), INDEX IDX_39A967D2567F5183 (film_id), PRIMARY KEY(genre_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, editeur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, annee_production DATE DEFAULT NULL, note INT DEFAULT NULL, synopsis LONGTEXT DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, bande_annonce VARCHAR(255) DEFAULT NULL, INDEX IDX_8244BE223375BD21 (editeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_producteur (film_id INT NOT NULL, producteur_id INT NOT NULL, INDEX IDX_C13F4358567F5183 (film_id), INDEX IDX_C13F4358AB9BB300 (producteur_id), PRIMARY KEY(film_id, producteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_acteur (film_id INT NOT NULL, acteur_id INT NOT NULL, INDEX IDX_8108EE68567F5183 (film_id), INDEX IDX_8108EE68DA6F574A (acteur_id), PRIMARY KEY(film_id, acteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_tag (film_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_1CBA72DB567F5183 (film_id), INDEX IDX_1CBA72DBBAD26311 (tag_id), PRIMARY KEY(film_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editeur (id INT NOT NULL, nationalite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acteur ADD CONSTRAINT FK_EAFAD362BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteur ADD CONSTRAINT FK_7EDBEE10BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_film ADD CONSTRAINT FK_39A967D24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_film ADD CONSTRAINT FK_39A967D2567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE223375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE film_producteur ADD CONSTRAINT FK_C13F4358567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_producteur ADD CONSTRAINT FK_C13F4358AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_acteur ADD CONSTRAINT FK_8108EE68567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_acteur ADD CONSTRAINT FK_8108EE68DA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_tag ADD CONSTRAINT FK_1CBA72DB567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_tag ADD CONSTRAINT FK_1CBA72DBBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeur ADD CONSTRAINT FK_5A747EFBF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film_tag DROP FOREIGN KEY FK_1CBA72DBBAD26311');
        $this->addSql('ALTER TABLE acteur DROP FOREIGN KEY FK_EAFAD362BF396750');
        $this->addSql('ALTER TABLE producteur DROP FOREIGN KEY FK_7EDBEE10BF396750');
        $this->addSql('ALTER TABLE editeur DROP FOREIGN KEY FK_5A747EFBF396750');
        $this->addSql('ALTER TABLE film_acteur DROP FOREIGN KEY FK_8108EE68DA6F574A');
        $this->addSql('ALTER TABLE film_producteur DROP FOREIGN KEY FK_C13F4358AB9BB300');
        $this->addSql('ALTER TABLE genre_film DROP FOREIGN KEY FK_39A967D24296D31F');
        $this->addSql('ALTER TABLE genre_film DROP FOREIGN KEY FK_39A967D2567F5183');
        $this->addSql('ALTER TABLE film_producteur DROP FOREIGN KEY FK_C13F4358567F5183');
        $this->addSql('ALTER TABLE film_acteur DROP FOREIGN KEY FK_8108EE68567F5183');
        $this->addSql('ALTER TABLE film_tag DROP FOREIGN KEY FK_1CBA72DB567F5183');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE223375BD21');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE acteur');
        $this->addSql('DROP TABLE producteur');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_film');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_producteur');
        $this->addSql('DROP TABLE film_acteur');
        $this->addSql('DROP TABLE film_tag');
        $this->addSql('DROP TABLE editeur');
    }
}
