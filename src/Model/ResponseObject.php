<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class ResponseObject
{
    public function __construct(
        public string $description,
        public ?MediaTypeObjectMap $content = null,
    ) {
    }
}