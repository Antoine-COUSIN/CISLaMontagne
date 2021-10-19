<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019100913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_role_center (user_id INT NOT NULL, role_center_id INT NOT NULL, INDEX IDX_42CDC300A76ED395 (user_id), INDEX IDX_42CDC3008C620AB (role_center_id), PRIMARY KEY(user_id, role_center_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_speciality (user_id INT NOT NULL, speciality_id INT NOT NULL, INDEX IDX_54B06662A76ED395 (user_id), INDEX IDX_54B066623B5A08D7 (speciality_id), PRIMARY KEY(user_id, speciality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_role_center ADD CONSTRAINT FK_42CDC300A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role_center ADD CONSTRAINT FK_42CDC3008C620AB FOREIGN KEY (role_center_id) REFERENCES role_center (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_speciality ADD CONSTRAINT FK_54B06662A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_speciality ADD CONSTRAINT FK_54B066623B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD grade_id INT DEFAULT NULL, ADD rank_id INT DEFAULT NULL, ADD fonction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497616678F FOREIGN KEY (rank_id) REFERENCES ranks (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64957889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FE19A1A8 ON user (grade_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497616678F ON user (rank_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64957889920 ON user (fonction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_role_center');
        $this->addSql('DROP TABLE user_speciality');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FE19A1A8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497616678F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64957889920');
        $this->addSql('DROP INDEX IDX_8D93D649FE19A1A8 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6497616678F ON user');
        $this->addSql('DROP INDEX IDX_8D93D64957889920 ON user');
        $this->addSql('ALTER TABLE user DROP grade_id, DROP rank_id, DROP fonction_id');
    }
}
