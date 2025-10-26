<?php

namespace Application\Department\UseCases\Handlers;

use Application\Department\UseCases\GetDepartmentByIpUseCase;
use Application\Geo\GeoLocationServiceInterface;
use Domain\Department\Entities\Department;
use Domain\Department\Queries\GetDepartmentByCityQuery;
use Domain\MessageBus\QueryBusInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetDepartmentByIpUseCaseHandler
{
    public function __construct(
        private GeoLocationServiceInterface $geoLocationService,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(GetDepartmentByIpUseCase $useCase): ?Department
    {
        $city = $this->geoLocationService->getCityByIp($useCase->ip);

        if (!$city) {
            return null;
        }

        return $this->queryBus->dispatch(new GetDepartmentByCityQuery($city));
    }
}
