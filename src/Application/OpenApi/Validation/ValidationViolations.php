<?php

namespace Application\OpenApi\Validation;

use Attribute;
use OpenApi\Attributes\AdditionalProperties;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class ValidationViolations extends Property
{
    /** @param array<int, Property> $properties */
    public function __construct(
        ?string $property,
        ?array $properties = [],
        ?AdditionalProperties $additionalProperties = null,
    ) {
        if ($properties) {
            parent::__construct(
                property: $property,
                type: 'object',
                additionalProperties: false,
                properties: $properties,
            );

            return;
        }

        if ($additionalProperties) {
            parent::__construct(
                property: $property,
                type: 'object',
                additionalProperties: $additionalProperties,
            );

            return;
        }

        parent::__construct(
            property: $property,
            type: 'array',
            items: new Items(type: 'string'),
        );
    }
}
