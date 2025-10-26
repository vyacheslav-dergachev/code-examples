<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\AsyncCommandBusInterface;

final class TestAsyncCommandBus implements AsyncCommandBusInterface
{
    private bool $enableStub = false;

    public function __construct(
        private AsyncCommandBusInterface $realAsyncCommandBus,
        private AsyncCommandBusStub $asyncCommandBusStub,
    ) {
    }

    /** {@inheritDoc} */
    public function dispatch(object $command): void
    {
        if (!$this->enableStub) {
            $this->realAsyncCommandBus->dispatch($command);
        }

        $this->asyncCommandBusStub->dispatch($command);
    }

    public function enableStub(): void
    {
        $this->enableStub = true;
    }

    public function disableStub(): void
    {
        $this->enableStub = false;
    }

    /** @return array<int, object> */
    public function getDispatchedCommands(): array
    {
        return $this->asyncCommandBusStub->getDispatchedCommands();
    }

    /**
     * @param class-string $commandClassName
     */
    public function assertIsDispatched(string $commandClassName): void
    {
        $this->asyncCommandBusStub->assertIsDispatched($commandClassName);
    }

    /**
     * @param class-string $commandClassName
     */
    public function assertIsNotDispatched(string $commandClassName): void
    {
        $this->asyncCommandBusStub->assertIsNotDispatched($commandClassName);
    }
}
