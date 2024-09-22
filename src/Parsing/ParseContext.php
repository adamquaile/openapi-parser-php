<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing;

use TypeSlow\OpenApiParser\Model\Version;

final readonly class ParseContext
{
    public function __construct(
        public Version $version,
        public Factory $factory,
        public DocumentPath $path = new DocumentPath(),
    ) {
    }
}
