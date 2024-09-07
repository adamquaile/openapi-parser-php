<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final readonly class ContactObject
{
    public function __construct(
        public string $name,
        public ?string $url,
        public ?string $email,
    ) {
    }
}
