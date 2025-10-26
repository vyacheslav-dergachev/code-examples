<?php

namespace Domain\Department\Queries;

final readonly class GetDepartmentByCityQuery
{
    public function __construct(
        public string $city,
    ) {
    }
}
