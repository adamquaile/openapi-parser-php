<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final readonly class LicenseObject
{
    public function __construct(
        public string $name,
        public ?string $identifier = null,
        public ?string $url = null,
    ) {
    }
}
