<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

use Traversable;

final class PathItemObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, PathItemObject> */
        public object $items
    ) {
    }
}
