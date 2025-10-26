<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\AsyncCommandBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class AsyncCommandBus implements AsyncCommandBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $asyncCommandBus,
    ) {
    }

    /** {@inheritDoc} */
    public function dispatch(object $command): void
    {
        try {
            $this->asyncCommandBus->dispatch($command);
        } catch (HandlerFailedException $handlerFailedException) {
            if ($handlerFailedException->getPrevious() instanceof Throwable) {
                throw $handlerFailedException->getPrevious();
            }

            throw $handlerFailedException;
        }
    }
}
