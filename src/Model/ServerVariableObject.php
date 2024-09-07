<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class ServerVariableObject
{
    public function __construct(
        public string $default,
        public string $description,
        public array $enum = [],
    ) {
    }
}