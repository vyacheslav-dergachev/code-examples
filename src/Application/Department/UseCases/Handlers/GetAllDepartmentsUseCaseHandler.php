<?php

namespace Application\Department\UseCases\Handlers;

use Application\Department\UseCases\GetAllDepartmentsUseCase;
use Domain\Department\Collections\DepartmentCollection;
use Domain\Department\Queries\GetAllDepartmentsQuery;
use Domain\MessageBus\QueryBusInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetAllDepartmentsUseCaseHandler
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function __invoke(GetAllDepartmentsUseCase $useCase): DepartmentCollection
    {
        return $this->queryBus->dispatch(new GetAllDepartmentsQuery());
    }
}
