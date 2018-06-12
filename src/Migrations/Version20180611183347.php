<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180611183347 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comanda ADD time INT NOT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE technician_id technician_id INT DEFAULT NULL, CHANGE status status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE customer CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone INT DEFAULT NULL, CHANGE postal_code postal_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE year year DATE DEFAULT NULL, CHANGE serial serial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE length length INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technician CHANGE workplace_id workplace_id INT DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT NULL, CHANGE postal_code postal_code INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comanda DROP time, CHANGE product_id product_id INT DEFAULT NULL, CHANGE technician_id technician_id INT DEFAULT NULL, CHANGE status status TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE customer CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE telephone telephone INT DEFAULT NULL, CHANGE postal_code postal_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE year year DATE DEFAULT \'NULL\', CHANGE serial serial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE length length INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technician CHANGE workplace_id workplace_id INT DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT \'NULL\', CHANGE postal_code postal_code INT DEFAULT NULL');
    }
}
