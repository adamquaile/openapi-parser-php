<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ServerObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $url,
        public ?string $description = null,
        public ?ServerVariablesObject $variables = null,
        public object $x = new \stdClass(),
    ) {
    }
}
