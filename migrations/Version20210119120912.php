<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119120912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60CA76ED395');
        $this->addSql('DROP INDEX IDX_14E8F60CA76ED395 ON messagerie');
        $this->addSql('ALTER TABLE messagerie CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60C67B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_14E8F60C67B3B43D ON messagerie (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60C67B3B43D');
        $this->addSql('DROP INDEX IDX_14E8F60C67B3B43D ON messagerie');
        $this->addSql('ALTER TABLE messagerie CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_14E8F60CA76ED395 ON messagerie (user_id)');
    }
}
