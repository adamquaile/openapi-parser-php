<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class ServerObject
{
    public function __construct(
        public string $url,
        public ?string $description = null,
        public ?ServerVariableObject $variables = null,
    ) {
    }
}