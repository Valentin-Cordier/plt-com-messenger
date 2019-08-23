<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190821093936 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amis (id_amis INT NOT NULL, id_user INT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(50) DEFAULT \'NULL\', password VARCHAR(50) NOT NULL, INDEX IDX_9FE2E7616B3CA4B (id_user), PRIMARY KEY(id_amis, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id_groupe INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id_groupe)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appartient (id_groupe INT NOT NULL, id_user INT NOT NULL, INDEX IDX_4201BAA7228E39CC (id_groupe), INDEX IDX_4201BAA76B3CA4B (id_user), PRIMARY KEY(id_groupe, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id_message INT AUTO_INCREMENT NOT NULL, id_groupe INT DEFAULT NULL, id_user INT DEFAULT NULL, message TEXT NOT NULL, INDEX message_groupe_FK (id_groupe), INDEX message_user0_FK (id_user), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_pri (id_message INT AUTO_INCREMENT NOT NULL, id_user_recevoir INT DEFAULT NULL, id_user INT DEFAULT NULL, message TEXT NOT NULL, INDEX message_pri_user_FK (id_user), INDEX message_pri_user0_FK (id_user_recevoir), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amis ADD CONSTRAINT FK_9FE2E7616B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT FK_4201BAA7228E39CC FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe)');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT FK_4201BAA76B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F228E39CC FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message_pri ADD CONSTRAINT FK_ABE2F926D42529C9 FOREIGN KEY (id_user_recevoir) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message_pri ADD CONSTRAINT FK_ABE2F9266B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appartient DROP FOREIGN KEY FK_4201BAA7228E39CC');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F228E39CC');
        $this->addSql('ALTER TABLE amis DROP FOREIGN KEY FK_9FE2E7616B3CA4B');
        $this->addSql('ALTER TABLE appartient DROP FOREIGN KEY FK_4201BAA76B3CA4B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6B3CA4B');
        $this->addSql('ALTER TABLE message_pri DROP FOREIGN KEY FK_ABE2F926D42529C9');
        $this->addSql('ALTER TABLE message_pri DROP FOREIGN KEY FK_ABE2F9266B3CA4B');
        $this->addSql('DROP TABLE amis');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE appartient');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_pri');
        $this->addSql('DROP TABLE user');
    }
}
