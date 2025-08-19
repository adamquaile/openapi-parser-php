<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class LinkObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, LinkObject|ReferenceObject> */
        public object $items
    ) {
    }
}
