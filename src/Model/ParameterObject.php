<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ParameterObject
{
    public function __construct(
        public string $name,
        public string $in,
        public ?string $description = null,
        public bool $required = false,
        public ?bool $deprecated = null,
        public ?bool $allowEmptyValue = null,
        public ?string $style = null,
        public ?bool $explode = null,
        public ?bool $allowReserved = null,
        public ?SchemaObject $schema = null,
        public ?array $example = null,
        public ?array $examples = null,
        public ?MediaTypeObject $content = null,
    ) {
    }
}