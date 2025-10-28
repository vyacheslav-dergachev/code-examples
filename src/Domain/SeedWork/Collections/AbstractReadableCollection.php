<?php

namespace Domain\SeedWork\Collections;

use Closure;
use Doctrine\Common\Collections\ReadableCollection;
use Traversable;

/**
 * @template TKey of array-key
 * @template T
 *
 * @template-implements ReadableCollection<TKey, T>
 */
abstract readonly class AbstractReadableCollection implements ReadableCollection
{
    /**
     * @param ReadableCollection<TKey, T> $items
     */
    public function __construct(
        protected ReadableCollection $items,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return $this->items->getIterator();
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->items->count();
    }

    /**
     * @inheritDoc
     */
    public function contains(mixed $element): bool
    {
        return $this->items->contains($element);
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function containsKey(int|string $key): bool
    {
        return $this->items->containsKey($key);
    }

    /**
     * @inheritDoc
     */
    public function get(int|string $key): mixed
    {
        return $this->items->get($key);
    }

    /**
     * @inheritDoc
     */
    public function getKeys(): array
    {
        return $this->items->getKeys();
    }

    /**
     * @inheritDoc
     */
    public function getValues()
    {
        return $this->items->getValues();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->items->toArray();
    }

    /**
     * @inheritDoc
     */
    public function first(): mixed
    {
        return $this->items->first();
    }

    /**
     * @inheritDoc
     */
    public function last(): mixed
    {
        return $this->items->last();
    }

    /**
     * @inheritDoc
     */
    public function key(): int|null|string
    {
        return $this->items->key();
    }

    /**
     * @inheritDoc
     */
    public function current(): mixed
    {
        return $this->items->current();
    }

    /**
     * @inheritDoc
     */
    public function next(): mixed
    {
        return $this->items->next();
    }

    /**
     * @inheritDoc
     */
    public function slice(int $offset, ?int $length = null): array
    {
        return $this->items->slice($offset, $length);
    }

    /**
     * @inheritDoc
     */
    public function exists(Closure $p): bool
    {
        return $this->items->exists($p);
    }

    /**
     * @inheritDoc
     */
    public function filter(Closure $p): ReadableCollection
    {
        return $this->items->filter($p);
    }

    /**
     * @inheritDoc
     */
    public function map(Closure $func): ReadableCollection
    {
        return $this->items->map($func);
    }

    /**
     * @inheritDoc
     */
    public function partition(Closure $p): array
    {
        return $this->items->partition($p);
    }

    /**
     * @inheritDoc
     */
    public function forAll(Closure $p): bool
    {
        return $this->items->forAll($p);
    }

    /**
     * @inheritDoc
     */
    public function indexOf(mixed $element): bool|int|string
    {
        return $this->items->indexOf($element);
    }

    /**
     * @inheritDoc
     */
    public function findFirst(Closure $p): mixed
    {
        return $this->items->findFirst($p);
    }

    /**
     * @inheritDoc
     */
    public function reduce(Closure $func, mixed $initial = null): mixed
    {
        return $this->items->reduce($func, $initial);
    }
}
