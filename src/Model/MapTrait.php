<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @mixin \IteratorAggregate
 * @mixin \ArrayAccess
 * @template MappedItem
 */
trait MapTrait
{
    /**
     * @return \Traversable<MappedItem>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
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
     * @param string $name
     * @return ?MappedItem
     */
    public function entryNamed(string $name): ?object
    {
        return $this->items[$name] ?? null;
    }
}
