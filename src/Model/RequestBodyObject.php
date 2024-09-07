<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class RequestBodyObject
{
    public function __construct(
        public ?string $description = null,
        public ?bool $required = null,
        public ?bool $deprecated = null,
        public ?bool $allowEmptyValue = null,
        public ?array $content = null,
        public ?array $extensions = null,
    ) {
    }
}
