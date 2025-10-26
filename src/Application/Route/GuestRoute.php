<?php

namespace Application\Route;

use Application\Route\ValueObjects\RoutePrefix;
use Symfony\Component\Routing\Annotation\Route;

#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
final class GuestRoute extends Route
{
    /**
     * @param array<string> $requirements
     * @param array<string>|string $methods
     * @param array<string>|string $schemes
     * @param array<mixed> $options
     * @param array<mixed> $defaults
     * @param array<mixed>|string|null $path
     */
    public function __construct(
        array|string|null $path,
        ?string $name = null,
        array $requirements = [],
        array $options = [],
        array $defaults = [],
        ?string $host = null,
        array|string $methods = [],
        array|string $schemes = [],
        ?string $condition = null,
        ?int $priority = null,
        ?string $locale = null,
        ?string $format = null,
        ?bool $utf8 = null,
        ?bool $stateless = null,
        ?string $env = null,
    ) {
        $namePrefix = RoutePrefix::Guest->value;

        parent::__construct(
            $path,
            $namePrefix . $name,
            $requirements,
            $options,
            $defaults,
            $host,
            $methods,
            $schemes,
            $condition,
            $priority,
            $locale,
            $format,
            $utf8,
            $stateless,
            $env,
        );
    }
}
