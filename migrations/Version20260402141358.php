<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260402141358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokemon_pokemon_type (ppt_pokemon_id INT NOT NULL, ppt_pkt_id INT NOT NULL, PRIMARY KEY (ppt_pokemon_id, ppt_pkt_id))');
        $this->addSql('CREATE INDEX IDX_F1F052B381475127 ON pokemon_pokemon_type (ppt_pokemon_id)');
        $this->addSql('CREATE INDEX IDX_F1F052B3807A487B ON pokemon_pokemon_type (ppt_pkt_id)');
        $this->addSql('ALTER TABLE pokemon_pokemon_type ADD CONSTRAINT FK_F1F052B381475127 FOREIGN KEY (ppt_pokemon_id) REFERENCES pokemons (pkm_id) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE pokemon_pokemon_type ADD CONSTRAINT FK_F1F052B3807A487B FOREIGN KEY (ppt_pkt_id) REFERENCES pokemon_types (pkt_id) NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon_pokemon_type DROP CONSTRAINT FK_F1F052B381475127');
        $this->addSql('ALTER TABLE pokemon_pokemon_type DROP CONSTRAINT FK_F1F052B3807A487B');
        $this->addSql('DROP TABLE pokemon_pokemon_type');
    }
}
