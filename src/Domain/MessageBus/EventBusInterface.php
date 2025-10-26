<?php

namespace Domain\MessageBus;

interface EventBusInterface
{
    public function dispatch(object $event): void;
}
