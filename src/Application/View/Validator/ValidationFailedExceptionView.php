<?php

namespace Application\View\Validator;

use OpenApi\Attributes as OA;

final class ValidationFailedExceptionView
{
    #[OA\Property(description: 'Exception message.', example: 'Validation Failed')]
    public string $message;

    /** @var array<string, array<string>> */
    #[ValidationViolationsView]
    public array $violations;
}
