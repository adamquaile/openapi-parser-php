<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

use Traversable;

final class SchemasObject implements \IteratorAggregate
{
    public function __construct(
        /** @var array<string, SchemaObject> */
        public array $schemas
    ) {
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->schemas);
    }
}
