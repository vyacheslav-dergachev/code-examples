<?php

namespace UserInterface\Http\Api;

use League\ObjectMapper\KeyFormatterWithoutConversion;
use League\ObjectMapper\ObjectMapperUsingReflection;
use League\ObjectMapper\ReflectionDefinitionProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @param class-string<object> $className
     * @param array<mixed> $payload
     */
    final protected function mapPayloadToUseCase(string $className, array $payload): object
    {
        $mapper = new ObjectMapperUsingReflection(
            new ReflectionDefinitionProvider(
                keyFormatter: new KeyFormatterWithoutConversion(),
            ),
        );

        return $mapper->hydrateObject($className, $payload);
    }

    /**
     * @return array<mixed>
     */
    final protected function getPayload(Request $request): array
    {
        try {
            $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $payload = [];
        }

        return $payload;
    }
}
