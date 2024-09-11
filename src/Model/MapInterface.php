<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @template MappedItem of object
 */
interface MapInterface extends \IteratorAggregate, \ArrayAccess
{
    /**
     * @return \Traversable<MappedItem>
     */
    public function getIterator(): \Traversable;

    public function offsetExists(mixed $offset): bool;

    public function offsetGet(mixed $offset): mixed;

    public function offsetSet(mixed $offset, mixed $value): void;
    public function offsetUnset(mixed $offset): void;

    /**
     * @param string $name
     * @return ?MappedItem
     */
    public function entryNamed(string $name): ?object;
}