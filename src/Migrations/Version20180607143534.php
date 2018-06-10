<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180607143534 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, dni VARCHAR(255) NOT NULL, name INT NOT NULL, email VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, postal_code INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, product_id INT DEFAULT NULL, workshop_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, datetime DATETIME NOT NULL, comments LONGTEXT DEFAULT NULL, INDEX IDX_F52993989395C3F3 (customer_id), INDEX IDX_F52993984584665A (product_id), INDEX IDX_F52993981FDCE57C (workshop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE part (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year DATE DEFAULT NULL, serial INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, length INT DEFAULT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technician (id INT AUTO_INCREMENT NOT NULL, workplace_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, postal_code INT DEFAULT NULL, INDEX IDX_F244E948AC25FB46 (workplace_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, postal_code INT NOT NULL, telephone INT NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id)');
        $this->addSql('ALTER TABLE technician ADD CONSTRAINT FK_F244E948AC25FB46 FOREIGN KEY (workplace_id) REFERENCES workshop (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981FDCE57C');
        $this->addSql('ALTER TABLE technician DROP FOREIGN KEY FK_F244E948AC25FB46');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE part');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE technician');
        $this->addSql('DROP TABLE workshop');
    }
}
