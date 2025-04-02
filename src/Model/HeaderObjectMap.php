<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class HeaderObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, HeaderObject|ReferenceObject> */
        public object $items
    ) {
    }
}
