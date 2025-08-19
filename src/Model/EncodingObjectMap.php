<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class EncodingObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, EncodingObject> */
        public object $items,
    ) {
    }
}
