<?php

namespace Application\View\Validator;

use Attribute;
use OpenApi\Attributes\AdditionalProperties;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class ValidationViolationsView extends Property
{
    public function __construct()
    {
        parent::__construct(
            description: 'Exception message.',
            type: 'object',
            example: ['basicInformation' => ['email' => ['The email must be a valid email address.']]],
            additionalProperties: new AdditionalProperties(
                anyOf: [
                    new Schema(
                        type: 'object',
                        additionalProperties: new AdditionalProperties(
                            anyOf: [
                                new Schema(type: 'array', items: new Items(type: 'string')),
                            ],
                        ),
                    ),
                    new Schema(type: 'array', items: new Items(type: 'string')),
                ],
            ),
        );
    }
}
