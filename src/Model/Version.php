<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

enum Version
{
    case V3_1;
    case V3_0;

    public static function fromString(mixed $version): self
    {
        return match (true) {
            $version === '3.1' || str_starts_with($version, '3.1.') => self::V3_1,
            $version === '3.0' || str_starts_with($version, '3.0.') => self::V3_0,
            default => throw new \InvalidArgumentException("Unsupported OpenAPI version: $version"),
        };
    }
}
