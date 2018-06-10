<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180609184007 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comanda (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, product_id INT DEFAULT NULL, workshop_id INT NOT NULL, technician_id INT DEFAULT NULL, status TINYINT(1) DEFAULT NULL, creation DATETIME NOT NULL, comments LONGTEXT DEFAULT NULL, INDEX IDX_45C50E549395C3F3 (customer_id), INDEX IDX_45C50E544584665A (product_id), INDEX IDX_45C50E541FDCE57C (workshop_id), INDEX IDX_45C50E54E6C5D496 (technician_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comanda_part (comanda_id INT NOT NULL, part_id INT NOT NULL, INDEX IDX_230CF10E787958A8 (comanda_id), INDEX IDX_230CF10E4CE34BEC (part_id), PRIMARY KEY(comanda_id, part_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comanda_service (comanda_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_C5B0A5F0787958A8 (comanda_id), INDEX IDX_C5B0A5F0ED5CA9E6 (service_id), PRIMARY KEY(comanda_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comanda ADD CONSTRAINT FK_45C50E549395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE comanda ADD CONSTRAINT FK_45C50E544584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE comanda ADD CONSTRAINT FK_45C50E541FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id)');
        $this->addSql('ALTER TABLE comanda ADD CONSTRAINT FK_45C50E54E6C5D496 FOREIGN KEY (technician_id) REFERENCES technician (id)');
        $this->addSql('ALTER TABLE comanda_part ADD CONSTRAINT FK_230CF10E787958A8 FOREIGN KEY (comanda_id) REFERENCES comanda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comanda_part ADD CONSTRAINT FK_230CF10E4CE34BEC FOREIGN KEY (part_id) REFERENCES part (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comanda_service ADD CONSTRAINT FK_C5B0A5F0787958A8 FOREIGN KEY (comanda_id) REFERENCES comanda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comanda_service ADD CONSTRAINT FK_C5B0A5F0ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE customer CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone INT DEFAULT NULL, CHANGE postal_code postal_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE year year DATE DEFAULT NULL, CHANGE serial serial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE length length INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technician CHANGE workplace_id workplace_id INT DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT NULL, CHANGE postal_code postal_code INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comanda_part DROP FOREIGN KEY FK_230CF10E787958A8');
        $this->addSql('ALTER TABLE comanda_service DROP FOREIGN KEY FK_C5B0A5F0787958A8');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, product_id INT DEFAULT NULL, workshop_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, datetime DATETIME NOT NULL, comments LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_F52993989395C3F3 (customer_id), INDEX IDX_F52993984584665A (product_id), INDEX IDX_F52993981FDCE57C (workshop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('DROP TABLE comanda');
        $this->addSql('DROP TABLE comanda_part');
        $this->addSql('DROP TABLE comanda_service');
        $this->addSql('ALTER TABLE customer CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE telephone telephone INT DEFAULT NULL, CHANGE postal_code postal_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE year year DATE DEFAULT \'NULL\', CHANGE serial serial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE length length INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technician CHANGE workplace_id workplace_id INT DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT \'NULL\', CHANGE postal_code postal_code INT DEFAULT NULL');
    }
}
