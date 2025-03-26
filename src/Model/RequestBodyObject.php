<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class RequestBodyObject implements HasSpecificationExtensions
{
    public function __construct(
        public MediaTypeObjectMap $content,
        public ?string $description = null,
        public bool $required = false,
        public ?object $x = new \stdClass(),
    ) {
    }
}
