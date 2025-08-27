<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class SecuritySchemeObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, SecuritySchemeObject|ReferenceObject> */
        public object $items
    ) {
    }
}