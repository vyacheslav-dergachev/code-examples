<?php

namespace Domain\Department\Queries\Handlers;

use Domain\Department\Entities\Department;
use Domain\Department\Queries\GetDepartmentByCityQuery;
use Domain\Department\Repositories\DepartmentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetDepartmentByCityQueryHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $repository,
    ) {
    }

    public function __invoke(GetDepartmentByCityQuery $query): ?Department
    {
        return $this->repository->findByCity($query->city);
    }
}
