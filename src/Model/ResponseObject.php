<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ResponseObject
{
    public function __construct(
        public string $description,
        public ?MediaTypeObjectMap $content = null,
    ) {
    }
}