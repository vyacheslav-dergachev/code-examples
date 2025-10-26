<?php

namespace UserInterface\Http\Api\Public\Department;

use Application\Department\UseCases\GetAllDepartmentsUseCase;
use Application\Department\UseCases\GetDepartmentByIpUseCase;
use Application\OpenApi\UseCase\UseCaseJsonContent;
use Application\OpenApi\Validation\ValidationFailedResponse;
use Application\Route\GuestRoute;
use Domain\Department\Collections\DepartmentCollection;
use Domain\MessageBus\QueryBusInterface;
use Nelmio\ApiDocBundle\Attribute\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use UserInterface\Http\Api\AbstractApiController;

#[GuestRoute(path: '/departments', name: 'get_all_departments', methods: ['GET'])]
#[Security(name: null)]
#[OA\Tag(name: 'Departments')]
#[OA\RequestBody(
    content: new UseCaseJsonContent(GetDepartmentByIpUseCase::class),
)]
#[OA\Response(
    response: Response::HTTP_OK,
)]
#[ValidationFailedResponse]
final class GetAllDepartmentsAction extends AbstractApiController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $response = [];

        foreach ($this->getAllDepartments() as $department) {
            // @TODO: create view factory
            $response[] = ['name' => $department->getName(), 'city' => $department->getCity(), 'phone' => $department->getPhone()];
        }

        return new JsonResponse($response, Response::HTTP_OK);
    }

    private function getAllDepartments(): DepartmentCollection
    {
        $useCase = new GetAllDepartmentsUseCase();

        return $this->queryBus->dispatch($useCase);
    }
}
