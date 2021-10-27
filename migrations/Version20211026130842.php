<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026130842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE control_vehicles ADD vehicles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE control_vehicles ADD CONSTRAINT FK_C00E99BA16F10C70 FOREIGN KEY (vehicles_id) REFERENCES vehicles (id)');
        $this->addSql('CREATE INDEX IDX_C00E99BA16F10C70 ON control_vehicles (vehicles_id)');
        $this->addSql('ALTER TABLE report_vehicle ADD vehicles_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE report_vehicle ADD CONSTRAINT FK_7B19998616F10C70 FOREIGN KEY (vehicles_id) REFERENCES vehicles (id)');
        $this->addSql('ALTER TABLE report_vehicle ADD CONSTRAINT FK_7B199986A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7B19998616F10C70 ON report_vehicle (vehicles_id)');
        $this->addSql('CREATE INDEX IDX_7B199986A76ED395 ON report_vehicle (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE control_vehicles DROP FOREIGN KEY FK_C00E99BA16F10C70');
        $this->addSql('DROP INDEX IDX_C00E99BA16F10C70 ON control_vehicles');
        $this->addSql('ALTER TABLE control_vehicles DROP vehicles_id');
        $this->addSql('ALTER TABLE report_vehicle DROP FOREIGN KEY FK_7B19998616F10C70');
        $this->addSql('ALTER TABLE report_vehicle DROP FOREIGN KEY FK_7B199986A76ED395');
        $this->addSql('DROP INDEX IDX_7B19998616F10C70 ON report_vehicle');
        $this->addSql('DROP INDEX IDX_7B199986A76ED395 ON report_vehicle');
        $this->addSql('ALTER TABLE report_vehicle DROP vehicles_id, DROP user_id');
    }
}
