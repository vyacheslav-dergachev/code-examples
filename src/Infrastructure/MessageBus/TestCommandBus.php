<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\CommandBusInterface;
use PHPUnit\Framework\Assert;

final class TestCommandBus implements CommandBusInterface
{
    private bool $enableStub = false;

    /** @var array<int, object> */
    private array $dispatchedCommands = [];

    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    /** {@inheritDoc} */
    public function dispatch(object $command): void
    {
        $this->dispatchedCommands[] = $command;

        if ($this->enableStub) {
            return;
        }

        $this->commandBus->dispatch($command);
    }

    /** {@inheritDoc} */
    public function dispatchWithRealCommandBus(object $command): void
    {
        $this->dispatchedCommands[] = $command;

        $this->commandBus->dispatch($command);
    }

    public function enableStub(): void
    {
        $this->enableStub = true;
    }

    public function disableStub(): void
    {
        $this->enableStub = false;
    }

    /**
     * @return array<int, object>
     */
    public function getDispatchedCommands(?string $suffix = null): array
    {
        if ($suffix === null) {
            return $this->dispatchedCommands;
        }

        return array_filter(
            $this->dispatchedCommands,
            static fn ($command) => str_ends_with((new \ReflectionClass($command))->getShortName(), $suffix),
        );
    }

    /** @phpstan-ignore return.unusedType */
    public function getLastDispatchedCommand(): ?object
    {
        return $this->dispatchedCommands[(int) (count($this->dispatchedCommands) - 1)];
    }

    /**
     * @param class-string $commandClassName
     */
    public function assertIsDispatched(string $commandClassName): void
    {
        foreach ($this->dispatchedCommands as $dispatchedCommand) {
            if ($dispatchedCommand instanceof $commandClassName) {
                /** @phpstan-ignore staticMethod.alreadyNarrowedType */
                Assert::assertTrue(true);

                return;
            }
        }

        Assert::fail(sprintf('Command %s was not dispatched', $commandClassName));
    }

    /**
     * @param class-string $commandClassName
     */
    public function assertIsNotDispatched(string $commandClassName): void
    {
        foreach ($this->dispatchedCommands as $dispatchedCommand) {
            if (!$dispatchedCommand instanceof $commandClassName) {
                continue;
            }

            Assert::fail(sprintf('Command %s was dispatched', $commandClassName));
        }

        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        Assert::assertTrue(true);
    }
}
