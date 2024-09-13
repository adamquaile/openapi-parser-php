<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

/**
 * @implements MapInterface<MediaTypeObject>
 */
final class MediaTypeObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, MediaTypeObject> */
        private object $items
    ) {
    }
}
