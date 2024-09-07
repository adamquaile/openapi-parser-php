<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

use Traversable;

/**
 * @implements MapTrait<PathItemObject>
 */
final class PathsObject implements \IteratorAggregate, \ArrayAccess
{
    use MapTrait;

    public function __construct(
        /** @var array<string, ResponseObject> */
        public array $items
    ) {
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }
}
