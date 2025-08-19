<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ParameterObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, ParameterObject|ReferenceObject> */
        public object $items,
    ) {
    }
}
