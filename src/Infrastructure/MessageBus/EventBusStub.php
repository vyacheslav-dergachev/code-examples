<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\EventBusInterface;
use PHPUnit\Framework\Assert;

final class EventBusStub implements EventBusInterface
{
    /** @var array<int, object> */
    private array $dispatchedEvents = [];

    /** {@inheritDoc} */
    public function dispatch(object $event): void
    {
        $this->dispatchedEvents[] = $event;
    }

    /** @return array<int, object> */
    public function getDispatchedEvents(): array
    {
        return $this->dispatchedEvents;
    }

    /**
     * @param class-string $eventClassName
     */
    public function assertIsDispatched(string $eventClassName): void
    {
        foreach ($this->dispatchedEvents as $dispatchedEvent) {
            if ($dispatchedEvent instanceof $eventClassName) {
                /** @phpstan-ignore staticMethod.alreadyNarrowedType */
                Assert::assertTrue(true);

                return;
            }
        }

        Assert::fail(sprintf('Event %s was not dispatched.', $eventClassName));
    }

    /**
     * @param class-string $eventClassName
     */
    public function assertIsDispatchedWithTimes(string $eventClassName, int $times): void
    {
        $dispatchedEvent = array_filter($this->dispatchedEvents, static fn ($dispatchedEvent): bool => $dispatchedEvent instanceof $eventClassName);

        Assert::assertCount($times, $dispatchedEvent, sprintf('The event %s has not been sent %s times.', $eventClassName, $times));
    }

    /**
     * @param class-string $eventClassName
     */
    public function assertIsNotDispatched(string $eventClassName): void
    {
        foreach ($this->dispatchedEvents as $dispatchedEvent) {
            if (!$dispatchedEvent instanceof $eventClassName) {
                continue;
            }

            Assert::fail(sprintf('Event %s was dispatched.', $eventClassName));
        }

        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        Assert::assertTrue(true);
    }
}
