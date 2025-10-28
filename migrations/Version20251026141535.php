<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Infrastructure\Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Uuid;

final class Version20251026141535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert initial departments data';
    }

    public function up(Schema $schema): void
    {
        $departments = [
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Kremlin',
                'city' => 'Moscow',
                'phone' => '+7-800-200-23-16'
            ],
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Smolny',
                'city' => 'Saint Petersburg',
                'phone' => '+7-812-576-78-06'
            ],
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Human Resources',
                'city' => 'New York',
                'phone' => '+1-555-0101'
            ],
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Engineering',
                'city' => 'San Francisco',
                'phone' => '+1-555-0102'
            ],
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Marketing',
                'city' => 'Chicago',
                'phone' => '+1-555-0103'
            ],
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Sales',
                'city' => 'Boston',
                'phone' => '+1-555-0104'
            ],
            [
                'id' => Uuid::v7()->toBinary(),
                'name' => 'Finance',
                'city' => 'Austin',
                'phone' => '+1-555-0105'
            ]
        ];

        foreach ($departments as $department) {
            $this->addSql(
                'INSERT INTO departments (id, name, city, phone) VALUES (:id, :name, :city, :phone)',
                $department
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM departments WHERE name IN (
            'Kremlin', 'Smolny', 'Human Resources', 'Engineering', 'Marketing', 'Sales', 'Finance'
        )");
    }
}
