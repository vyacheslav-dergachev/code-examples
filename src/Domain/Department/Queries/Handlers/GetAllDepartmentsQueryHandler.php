<?php

namespace Domain\Department\Queries\Handlers;

use Domain\Department\Collections\DepartmentCollection;
use Domain\Department\Queries\GetAllDepartmentsQuery;
use Domain\Department\Repositories\DepartmentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetAllDepartmentsQueryHandler
{
    public function __construct(
        private DepartmentRepositoryInterface $repository,
    ) {
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function __invoke(GetAllDepartmentsQuery $query): DepartmentCollection
    {
        return $this->repository->findAll();
    }
}
