<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

use Traversable;

/**
 * @implements MapInterface<PathItemObject>
 */
final class PathsObject implements MapInterface
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
