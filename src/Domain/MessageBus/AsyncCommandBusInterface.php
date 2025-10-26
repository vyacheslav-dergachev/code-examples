<?php

namespace Domain\MessageBus;

use Throwable;

interface AsyncCommandBusInterface
{
    /** @throws Throwable */
    public function dispatch(object $command): void;
}
