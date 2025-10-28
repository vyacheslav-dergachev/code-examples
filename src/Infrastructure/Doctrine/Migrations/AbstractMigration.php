<?php

namespace Infrastructure\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration as SymfonyAbstractMigration;

abstract class AbstractMigration extends SymfonyAbstractMigration
{
    protected function isTestEnvironment(): bool
    {
        // phpcs:ignore SlevomatCodingStandard.Variables.DisallowSuperGlobalVariable.DisallowedSuperGlobalVariable
        $env = getenv('APP_ENV') ?: ($_SERVER['APP_ENV'] ?? 'prod');

        return $env === 'test';
    }
}
