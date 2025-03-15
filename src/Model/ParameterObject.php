<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ParameterObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $name,
        public string $in,
        public ?string $description = null,
        public bool $required = false,
        public ?bool $deprecated = false,
        public ?bool $allowEmptyValue = false,
        public ?string $style = null,
        public ?bool $explode = null,
        public ?bool $allowReserved = false,
        public ?SchemaObject $schema = null,
        public mixed $example = null,
        public ?ParameterObjectExamplesMap $examples = null,
        public ?MediaTypeObject $content = null,
        public object $x = new \stdClass(),
    ) {
    }
}
