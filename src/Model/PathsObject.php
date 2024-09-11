<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @implements MapInterface<PathItemObject>
 */
final class PathsObject implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var array<string, PathItemObject> */
        public array $items
    ) {
    }
}
