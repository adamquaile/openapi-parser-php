<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

/**
 * @implements MapInterface<PathItemObject>
 */
final class PathsObject implements MapInterface, HasSpecificationExtensions
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, PathItemObject> */
        public object $items,
        public object $x = new \stdClass(),
    ) {
    }
}
