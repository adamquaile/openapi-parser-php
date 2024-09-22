<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ComponentsObject
{
    public function __construct(
        public ?SchemasObject $schemas = null,
        public ?ResponsesObject $responses = null,
    ) {
    }
}