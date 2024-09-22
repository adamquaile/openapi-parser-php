<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

/**
 * @mixin MapInterface
 * @template MappedItem of object
 */
trait MapTrait
{
    /**
     * @param string $offset
     * @return MappedItem
     */
    public function __get(string $offset): ?object
    {
        return $this->items->$offset ?? null;
    }

    /**
     * @return \Traversable<MappedItem>
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->items as $key => $item) {
            yield $key => $item;
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items->$offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items->$offset;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \LogicException(__CLASS__ . ' is immutable');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \LogicException(__CLASS__ . ' is immutable');
    }

    /**
     * @param string $offset
     * @return ?MappedItem
     */
    public function entryNamed(string $offset): ?object
    {
        return $this->items->$offset ?? null;
    }
}
