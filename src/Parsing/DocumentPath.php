<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing;

final readonly class DocumentPath
{
    public function __construct(
        private string $path = '$',
    ) {
    }

    public function append(string $path): static
    {
        return new self($this->path . "." . $path);
    }

    public function __toString(): string
    {
        return $this->path;
    }
}
