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
        /** @var array<string, MediaTypeObject> */
        private array $items
    ) {
    }
}
