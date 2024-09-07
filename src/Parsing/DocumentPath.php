<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing;

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
