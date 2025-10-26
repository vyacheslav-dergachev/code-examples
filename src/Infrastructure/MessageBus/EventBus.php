<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\EventBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class EventBus implements EventBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $eventBus,
    ) {
    }

    /** {@inheritDoc} */
    public function dispatch(object $event): void
    {
        try {
            $this->eventBus->dispatch($event);
        } catch (HandlerFailedException $handlerFailedException) {
            if ($handlerFailedException->getPrevious() instanceof Throwable) {
                throw $handlerFailedException->getPrevious();
            }

            throw $handlerFailedException;
        }
    }
}
