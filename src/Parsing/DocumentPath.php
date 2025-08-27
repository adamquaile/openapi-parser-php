<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing;

final readonly class DocumentPath
{
    public function __construct(
    ) {
    }

    public function __toString(): string
    {
        return '$';
    }
}
