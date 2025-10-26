<?php

namespace Application\OpenApi\Validation;

use Application\View\Validator\ValidationFailedExceptionView;
use Attribute;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class ValidationFailedJsonContent extends JsonContent
{
    public static function default(): self
    {
        return new self(
            ref: new Model(
                type: ValidationFailedExceptionView::class,
            ),
        );
    }

    public static function withViolations(Property $violationsView): self
    {
        return new self(
            properties: [
                new Property(
                    property: 'message',
                    type: 'string',
                    description: 'Exception message.',
                    example: 'Validation Failed',
                ),
                $violationsView,
            ],
        );
    }
}
