<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final readonly class SchemaObject
{
    public function __construct(
        public ?string $type = null,
        public ?bool $nullable = null,
    ) {
    }
}
