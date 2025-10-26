<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\EventBusInterface;

final class TestEventBus implements EventBusInterface
{
    private bool $enableStub = false;

    public function __construct(
        private EventBusInterface $realEventBus,
        private EventBusStub $eventBusStub,
    ) {
    }

    /** {@inheritDoc} */
    public function dispatch(object $event): void
    {
        if (!$this->enableStub) {
            $this->realEventBus->dispatch($event);
        }

        $this->eventBusStub->dispatch($event);
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
    public function getDispatchedEvents(): array
    {
        return $this->eventBusStub->getDispatchedEvents();
    }

    /**
     * @param class-string $eventClassName
     */
    public function assertIsDispatched(string $eventClassName): void
    {
        $this->eventBusStub->assertIsDispatched($eventClassName);
    }

    /**
     * @param class-string $eventClassName
     */
    public function assertIsDispatchedWithTimes(string $eventClassName, int $times): void
    {
        $this->eventBusStub->assertIsDispatchedWithTimes($eventClassName, $times);
    }

    /**
     * @param class-string $eventClassName
     */
    public function assertIsNotDispatched(string $eventClassName): void
    {
        $this->eventBusStub->assertIsNotDispatched($eventClassName);
    }
}
