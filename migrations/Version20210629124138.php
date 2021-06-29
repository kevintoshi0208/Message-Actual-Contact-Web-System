<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629124138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, wgs84_n NUMERIC(8, 3) NOT NULL, wgs84_e NUMERIC(8, 3) NOT NULL, created_time DATETIME DEFAULT NULL COMMENT \'建立資料時間\', updated_time DATETIME DEFAULT NULL COMMENT \'異動資料時間\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiting (id BIGINT AUTO_INCREMENT NOT NULL, business_id BIGINT DEFAULT NULL, created_time DATETIME DEFAULT NULL COMMENT \'建立資料時間\', updated_time DATETIME DEFAULT NULL COMMENT \'異動資料時間\', phone VARCHAR(20) NOT NULL, INDEX IDX_835451ADA89DB457 (business_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visiting ADD CONSTRAINT FK_835451ADA89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visiting DROP FOREIGN KEY FK_835451ADA89DB457');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE visiting');
    }
}
