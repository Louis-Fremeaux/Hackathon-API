<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930090017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hackathon_membre_jury (hackathon_id INT NOT NULL, membre_jury_id INT NOT NULL, INDEX IDX_B5FAB720996D90CF (hackathon_id), INDEX IDX_B5FAB72057471281 (membre_jury_id), PRIMARY KEY(hackathon_id, membre_jury_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hackathon_membre_jury ADD CONSTRAINT FK_B5FAB720996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hackathon_membre_jury ADD CONSTRAINT FK_B5FAB72057471281 FOREIGN KEY (membre_jury_id) REFERENCES membre_jury (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe ADD projet_id INT DEFAULT NULL, ADD be_responsable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA157541A5FF FOREIGN KEY (be_responsable_id) REFERENCES inscription (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15C18272 ON equipe (projet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2449BA157541A5FF ON equipe (be_responsable_id)');
        $this->addSql('ALTER TABLE inscription ADD hackathon_id INT DEFAULT NULL, ADD equipe_id INT DEFAULT NULL, ADD participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D66D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6996D90CF ON inscription (hackathon_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D66D861B89 ON inscription (equipe_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D69D1C3019 ON inscription (participant_id)');
        $this->addSql('ALTER TABLE projet ADD hackathon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9996D90CF ON projet (hackathon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hackathon_membre_jury DROP FOREIGN KEY FK_B5FAB720996D90CF');
        $this->addSql('ALTER TABLE hackathon_membre_jury DROP FOREIGN KEY FK_B5FAB72057471281');
        $this->addSql('DROP TABLE hackathon_membre_jury');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15C18272');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA157541A5FF');
        $this->addSql('DROP INDEX IDX_2449BA15C18272 ON equipe');
        $this->addSql('DROP INDEX UNIQ_2449BA157541A5FF ON equipe');
        $this->addSql('ALTER TABLE equipe DROP projet_id, DROP be_responsable_id');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9996D90CF');
        $this->addSql('DROP INDEX IDX_50159CA9996D90CF ON projet');
        $this->addSql('ALTER TABLE projet DROP hackathon_id');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6996D90CF');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D66D861B89');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69D1C3019');
        $this->addSql('DROP INDEX IDX_5E90F6D6996D90CF ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D66D861B89 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D69D1C3019 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP hackathon_id, DROP equipe_id, DROP participant_id');
    }
}
