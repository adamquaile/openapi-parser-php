<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final readonly class TagObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?ExternalDocumentationObject $externalDocs = null,
        public object $x = new \stdClass(),
    ) {
    }
}
