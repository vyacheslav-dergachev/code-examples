<?php

namespace Domain\Department\Collections;

use Domain\Department\Entities\Department;
use Domain\SeedWork\Collections\AbstractReadableCollection;

/**
 * @extends AbstractReadableCollection<int, Department>
 */
final readonly class DepartmentCollection extends AbstractReadableCollection
{
    public function filterByCity(string $city): self
    {
        return new self($this->items->filter(static fn (Department $department) => $department->getCity() === $city));
    }

    public function findOneByCity(string $city): ?Department
    {
        $department = $this->filterByCity($city)->first();

        if (!$department) {
            return null;
        }

        return $department;
    }
}
