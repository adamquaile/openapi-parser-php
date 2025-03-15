<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ParameterObjectExamplesMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, ExampleObject|ReferenceObject> */
        public object $items
    ) {
    }
}
