<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class CallbackObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, CallbackObject|ReferenceObject> */
        public object $items
    ) {
    }
}
