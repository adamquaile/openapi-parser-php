<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @implements MapTrait<MediaTypeObject>
 */
final class MediaTypeObjectMap implements \IteratorAggregate, \ArrayAccess
{
    use MapTrait;

    public function __construct(
        /** @var array<string, MediaTypeObject> */
        private array $items
    ) {
    }
}
