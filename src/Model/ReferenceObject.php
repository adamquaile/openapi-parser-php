<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final readonly class ReferenceObject
{
    public function __construct(
        public string $ref,
        public ?string $name = null,
        public ?string $description = null
    ) {
    }
}
