<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final readonly class ContactObject
{
    public function __construct(
        public ?string $name = null,
        public ?string $url = null,
        public ?string $email = null,
    ) {
    }
}
