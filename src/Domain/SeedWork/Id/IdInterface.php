<?php

namespace Domain\SeedWork\Id;

interface IdInterface
{
    public function equals(self $id): bool;

    public function toString(): string;

    public function __toString(): string;
}
