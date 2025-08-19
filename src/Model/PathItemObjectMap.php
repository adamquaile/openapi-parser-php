<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

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
