<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class ComponentsObject
{
    public function __construct(
        public ?SchemasObject $schemas = null,
        public ?ResponsesObject $responses = null,
    ) {
    }
}