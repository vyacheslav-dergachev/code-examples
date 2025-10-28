<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Infrastructure\Doctrine\Migrations\AbstractMigration;

final class Version20251026134444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add the `departments` table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE departments (
                id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)',
                name VARCHAR(255) NOT NULL,
                city VARCHAR(255) NOT NULL,
                phone VARCHAR(255) NOT NULL,
                UNIQUE INDEX UNIQ_16AEB8D45E237E06 (name),
                UNIQUE INDEX UNIQ_16AEB8D42D5B0234 (city),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE departments');
    }
}
