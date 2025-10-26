<?php

namespace UserInterface\Http\Api;

use Nelmio\ApiDocBundle\Attribute\Security;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Security(name: null)]
#[OA\Tag(name: 'Default')]
final class DefaultApiController extends AbstractController
{
    #[Route(path: '/', methods: ['GET'], name: 'app_api_default')]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Default API path',
    )]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Welcome!',
        ], Response::HTTP_OK);
    }
}
