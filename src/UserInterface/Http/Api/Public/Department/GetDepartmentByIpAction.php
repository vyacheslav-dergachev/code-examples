<?php

namespace UserInterface\Http\Api\Public\Department;

use Application\Department\UseCases\GetDepartmentByIpUseCase;
use Application\OpenApi\UseCase\UseCaseJsonContent;
use Application\OpenApi\Validation\ValidationFailedResponse;
use Application\Route\GuestRoute;
use Domain\Department\Entities\Department;
use Domain\MessageBus\QueryBusInterface;
use Nelmio\ApiDocBundle\Attribute\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserInterface\Http\Api\AbstractApiController;

#[GuestRoute(path: '/department-by-ip', name: 'get_department_by_ip', methods: ['GET'])]
#[Security(name: null)]
#[OA\Tag(name: 'Departments')]
#[OA\RequestBody(
    content: new UseCaseJsonContent(GetDepartmentByIpUseCase::class),
)]
#[OA\Response(
    response: Response::HTTP_OK,
)]
#[ValidationFailedResponse]
final class GetDepartmentByIpAction extends AbstractApiController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $department = $this->getDepartmentByIp($request);

        $response = $department
            ? ['name' => $department->getName(), 'city' => $department->getCity(), 'phone' => $department->getPhone()]
            : [];
        // @TODO: create view factory

        return new JsonResponse($response, Response::HTTP_OK);
    }

    private function getDepartmentByIp(Request $request): ?Department
    {
        $clientIp = $request->getClientIp();

        if ($clientIp === null) {
            return null;
        }

        $useCase = new GetDepartmentByIpUseCase();
        $useCase->ip = $clientIp;

        return $this->queryBus->dispatch($useCase);
    }
}
