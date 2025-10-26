<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\AsyncCommandBusInterface;
use PHPUnit\Framework\Assert;
use Symfony\Component\Messenger\Envelope;

final class AsyncCommandBusStub implements AsyncCommandBusInterface
{
    /** @var array<int, object> */
    private array $dispatchedCommands = [];

    /** {@inheritDoc} */
    public function dispatch(object $command): void
    {
        if ($command instanceof Envelope) {
            $command = $command->getMessage();
        }

        $this->dispatchedCommands[] = $command;
    }

    /** @return array<int, object> */
    public function getDispatchedCommands(): array
    {
        return $this->dispatchedCommands;
    }

    /**
     * @param class-string $commandClassName
     */
    public function assertIsDispatched(string $commandClassName): void
    {
        foreach ($this->dispatchedCommands as $dispatchedAsyncCommand) {
            if ($dispatchedAsyncCommand instanceof $commandClassName) {
                /** @phpstan-ignore staticMethod.alreadyNarrowedType */
                Assert::assertTrue(true);

                return;
            }
        }

        Assert::fail(sprintf('Command %s was not dispatched.', $commandClassName));
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

            Assert::fail(sprintf('Command %s was dispatched.', $commandClassName));
        }

        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        Assert::assertTrue(true);
    }
}
