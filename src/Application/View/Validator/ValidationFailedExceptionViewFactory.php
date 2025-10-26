<?php

namespace Application\View\Validator;

use Symfony\Component\Messenger\Exception\ValidationFailedException;

final readonly class ValidationFailedExceptionViewFactory
{
    public function __construct(
        private ViolationViewFactory $violationViewFactory,
    ) { }

    public function create(ValidationFailedException $exception): ValidationFailedExceptionView
    {
        $exceptionView = new ValidationFailedExceptionView();
        $exceptionView->message = 'Validation Failed';
        $exceptionView->violations = $this->violationViewFactory->createCollection($exception->getViolations());

        return $exceptionView;
    }
}
