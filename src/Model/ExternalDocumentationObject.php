<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class ExternalDocumentationObject
{
    public function __construct(
        public string $url,
        public ?string $description = null,
    ) {
    }
}
