<?php

namespace Domain\SeedWork\Id;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

final class Uuid implements IdInterface
{
    private function __construct(
        private SymfonyUuid $uuid,
    ) {
    }

    public static function fromString(string $uuidV7): self
    {
        return new self(SymfonyUuid::fromString($uuidV7));
    }

    public static function v7(): self
    {
        return new self(SymfonyUuid::v7());
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return (string) $this->uuid;
    }

    public function toBinary(): string
    {
        return $this->uuid->toBinary();
    }

    public function equals(IdInterface $id): bool
    {
        return $this->toString() === $id->toString();
    }
}
