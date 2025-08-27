<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ServerVariableObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, ServerVariableObject> */
        public object $items
    ) {
    }
}
