<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class CallbackObject implements HasSpecificationExtensions
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, PathItemObject|ReferenceObject> */
        public object $items,
        public object $x = new \stdClass(),
    ) {
    }
}
