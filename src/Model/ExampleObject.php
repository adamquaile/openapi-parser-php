<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ExampleObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $summary,
        public object $value,
        public object $x = new \stdClass(),
    ) {
    }
}
