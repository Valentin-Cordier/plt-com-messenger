<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190821094529 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appartient (id_groupe INT NOT NULL, id_user INT NOT NULL, INDEX IDX_4201BAA7228E39CC (id_groupe), INDEX IDX_4201BAA76B3CA4B (id_user), PRIMARY KEY(id_groupe, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_pri (id_message INT AUTO_INCREMENT NOT NULL, id_user_recevoir INT DEFAULT NULL, id_user INT DEFAULT NULL, message TEXT NOT NULL, INDEX message_pri_user_FK (id_user), INDEX message_pri_user0_FK (id_user_recevoir), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT FK_4201BAA7228E39CC FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe)');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT FK_4201BAA76B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message_pri ADD CONSTRAINT FK_ABE2F926D42529C9 FOREIGN KEY (id_user_recevoir) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message_pri ADD CONSTRAINT FK_ABE2F9266B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('DROP TABLE messaepri');
        $this->addSql('ALTER TABLE amis MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE amis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE amis ADD id_amis INT NOT NULL, ADD id_user INT NOT NULL, ADD username VARCHAR(50) NOT NULL, ADD email VARCHAR(50) DEFAULT \'NULL\', ADD password VARCHAR(50) NOT NULL, DROP id');
        $this->addSql('ALTER TABLE amis ADD CONSTRAINT FK_9FE2E7616B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('CREATE INDEX IDX_9FE2E7616B3CA4B ON amis (id_user)');
        $this->addSql('ALTER TABLE amis ADD PRIMARY KEY (id_amis, id_user)');
        $this->addSql('ALTER TABLE groupe MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE groupe DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE groupe ADD nom VARCHAR(50) NOT NULL, CHANGE id id_groupe INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE groupe ADD PRIMARY KEY (id_groupe)');
        $this->addSql('ALTER TABLE message MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE message DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE message ADD id_groupe INT DEFAULT NULL, ADD id_user INT DEFAULT NULL, ADD message TEXT NOT NULL, CHANGE id id_message INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F228E39CC FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('CREATE INDEX message_groupe_FK ON message (id_groupe)');
        $this->addSql('CREATE INDEX message_user0_FK ON message (id_user)');
        $this->addSql('ALTER TABLE message ADD PRIMARY KEY (id_message)');
        $this->addSql('ALTER TABLE user ADD id_user INT NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE messaepri (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE appartient');
        $this->addSql('DROP TABLE message_pri');
        $this->addSql('ALTER TABLE amis DROP FOREIGN KEY FK_9FE2E7616B3CA4B');
        $this->addSql('DROP INDEX IDX_9FE2E7616B3CA4B ON amis');
        $this->addSql('ALTER TABLE amis DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE amis ADD id INT AUTO_INCREMENT NOT NULL, DROP id_amis, DROP id_user, DROP username, DROP email, DROP password');
        $this->addSql('ALTER TABLE amis ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE groupe MODIFY id_groupe INT NOT NULL');
        $this->addSql('ALTER TABLE groupe DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE groupe DROP nom, CHANGE id_groupe id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE groupe ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE message MODIFY id_message INT NOT NULL');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F228E39CC');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6B3CA4B');
        $this->addSql('DROP INDEX message_groupe_FK ON message');
        $this->addSql('DROP INDEX message_user0_FK ON message');
        $this->addSql('ALTER TABLE message DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE message DROP id_groupe, DROP id_user, DROP message, CHANGE id_message id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE message ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user DROP id_user, DROP username, DROP email, DROP password');
    }
}
