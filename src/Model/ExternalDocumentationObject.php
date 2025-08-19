<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ExternalDocumentationObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $url,
        public ?string $description = null,
        public ?object $x = new \stdClass(),
    ) {
    }
}
