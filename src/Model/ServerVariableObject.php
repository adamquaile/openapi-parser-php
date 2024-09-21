<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class ServerVariableObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $default,
        public ?string $description = null,
        public ?array $enum = null,
        public object $x = new \stdClass(),
    ) {
    }
}
