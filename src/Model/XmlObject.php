<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class XmlObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?string $name = null,
        public ?string $namespace = null,
        public ?string $prefix = null,
        public ?bool $attribute = null,
        public ?bool $wrapped = null,
        public object $x = new \stdClass(),
    ) {
    }
}
