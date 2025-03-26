<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class HeaderObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?string $description = null,
        public bool $required = false,
        public ?bool $deprecated = false,
        public ?bool $allowEmptyValue = false,
        public ?string $style = null,
        public ?bool $explode = null,
        public ?bool $allowReserved = false,
        public ?SchemaObject $schema = null,
        public mixed $example = null,
        public ?HeaderObjectExamplesMap $examples = null,
        public ?MediaTypeObjectMap $content = null,
        public object $x = new \stdClass(),
    ) {
    }
}
