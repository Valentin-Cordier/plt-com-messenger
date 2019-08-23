<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190821093323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE amis ADD PRIMARY KEY (id_amis, id_user)');
        $this->addSql('ALTER TABLE appartient RENAME INDEX appartient_user0_fk TO IDX_4201BAA76B3CA4B');
        $this->addSql('ALTER TABLE message CHANGE id_groupe id_groupe INT DEFAULT NULL, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message_pri CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_user_recevoir id_user_recevoir INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user MODIFY id_user INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_user id_user INT NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE amis ADD PRIMARY KEY (id_user, id_amis)');
        $this->addSql('ALTER TABLE appartient RENAME INDEX idx_4201baa76b3ca4b TO appartient_user0_FK');
        $this->addSql('ALTER TABLE message CHANGE id_groupe id_groupe INT NOT NULL, CHANGE id_user id_user INT NOT NULL');
        $this->addSql('ALTER TABLE message_pri CHANGE id_user_recevoir id_user_recevoir INT NOT NULL, CHANGE id_user id_user INT NOT NULL');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user DROP id, CHANGE id_user id_user INT AUTO_INCREMENT NOT NULL, CHANGE username username VARCHAR(50) NOT NULL COLLATE latin1_swedish_ci, CHANGE email email VARCHAR(50) NOT NULL COLLATE latin1_swedish_ci, CHANGE password password VARCHAR(50) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id_user)');
    }
}
