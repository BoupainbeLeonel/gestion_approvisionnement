<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215153203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approvisionnement (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, date DATETIME NOT NULL, montant_total DOUBLE PRECISION NOT NULL, statut VARCHAR(50) NOT NULL, fournisseur_id INT DEFAULT NULL, INDEX IDX_516C3FAA670C757F (fournisseur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE approvisionnement_article (approvisionnement_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_6991E8BEAE741A98 (approvisionnement_id), INDEX IDX_6991E8BE7294869C (article_id), PRIMARY KEY (approvisionnement_id, article_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE approvisionnement ADD CONSTRAINT FK_516C3FAA670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE approvisionnement_article ADD CONSTRAINT FK_6991E8BEAE741A98 FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE approvisionnement_article ADD CONSTRAINT FK_6991E8BE7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement DROP FOREIGN KEY FK_516C3FAA670C757F');
        $this->addSql('ALTER TABLE approvisionnement_article DROP FOREIGN KEY FK_6991E8BEAE741A98');
        $this->addSql('ALTER TABLE approvisionnement_article DROP FOREIGN KEY FK_6991E8BE7294869C');
        $this->addSql('DROP TABLE approvisionnement');
        $this->addSql('DROP TABLE approvisionnement_article');
    }
}
