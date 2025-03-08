<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class DiscriminatorObject implements HasSpecificationExtensions
{
    public function __construct(
        public string  $propertyName,
        public ?object $mapping = null,
        public object $x = new \stdClass(),
    ) {
    }
}
