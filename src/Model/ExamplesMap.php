<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ExamplesMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, ExampleObject|ReferenceObject> */
        public object $items
    ) {
    }
}
