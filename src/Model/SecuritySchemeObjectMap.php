<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class SecuritySchemeObjectMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, SecuritySchemeObject|ReferenceObject> */
        public object $items
    ) {
    }
}