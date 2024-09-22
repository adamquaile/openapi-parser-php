<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class MediaTypeObject
{
    public function __construct(
        public ?SchemaObject $schema = null,
        public mixed $example = null,
        public ?array $examples = null,
        public ?array $encoding = null,
    ) {
    }
}
