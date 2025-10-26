<?php

namespace Application\View\Validator;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ViolationViewFactory
{
    /**
     * @return array<string, array<string>>
     */
    public function createCollection(ConstraintViolationListInterface $violations): array
    {
        $normalizedViolations = [];

        foreach ($violations as $violation) {
            /** @phpcsSuppress SlevomatCodingStandard.PHP.DisallowReference */
            $currentData = &$normalizedViolations;

            foreach (self::splitPropertyPathIntoParts($violation->getPropertyPath()) as $propertyPathElement) {
                /** @phpcsSuppress SlevomatCodingStandard.PHP.DisallowReference */
                $currentData = &$currentData[$propertyPathElement];
            }

            $currentData[] = $violation->getMessage();
        }

        return $normalizedViolations;
    }

    /**
     * @return array<int, string>
     */
    private static function splitPropertyPathIntoParts(string $propertyPath): array
    {
        $propertyPath = str_replace(['[', ']'], ['.', ''], $propertyPath);

        return explode('.', $propertyPath);
    }
}
