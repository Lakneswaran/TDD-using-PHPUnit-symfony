<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118081343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookings (id INT AUTO_INCREMENT NOT NULL, relation_id INT NOT NULL, room_id INT NOT NULL, start_date VARCHAR(255) DEFAULT NULL, end_date VARCHAR(255) NOT NULL, INDEX IDX_7A853C353256915B (relation_id), INDEX IDX_7A853C3554177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, only_for_premium_members TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, credit INT DEFAULT 100 NOT NULL, premium_member TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C353256915B FOREIGN KEY (relation_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C3554177093 FOREIGN KEY (room_id) REFERENCES room (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C3554177093');
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C353256915B');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE `user`');
    }
}
