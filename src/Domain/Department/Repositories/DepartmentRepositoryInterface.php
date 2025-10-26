<?php

namespace Domain\Department\Repositories;

use Domain\Department\Entities\Department;
use Domain\SeedWork\Id\Uuid;

interface DepartmentRepositoryInterface
{
    public function save(Department $department): void;

    /** @param list<Department> $departments */
    public function saveAll(array $departments): void;

    public function delete(Department $department): void;

    public function findById(Uuid $id): ?Department;

    /**
     * @return list<Department>
     */
    public function findAll(): array;

    public function findByCity(string $city): ?Department;
}
