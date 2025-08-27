<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing;

use AdamQ\OpenApiParser\Model\Version;

final readonly class ParseContext
{
    public function __construct(
        public Version $version,
        public Factory $factory,
        public DocumentPath $path = new DocumentPath(),
    ) {
    }

    public function withPath(DocumentPath $path): self
    {
        return new self(
            version: $this->version,
            factory: $this->factory,
            path: $path,
        );
    }
}
