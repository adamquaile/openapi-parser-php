<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final readonly class ContactObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?string $name = null,
        public ?string $url = null,
        public ?string $email = null,
        public object $x = new \stdClass(),
    ) {
    }
}
