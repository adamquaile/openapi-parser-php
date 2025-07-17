<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class OperationObjectCallbacksMap
{
    use MapTrait;

    /**
     * @param \Traversable<string, CallbackObject|ReferenceObject> $items
     */
    public function __construct(
        public object $items
    ) {
    }
}