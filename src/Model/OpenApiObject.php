<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final readonly class OpenApiObject
{
    public function __construct(
        public string $openapi,
        public InfoObject $info,
        public ?PathsObject $paths = null,
        public ?ComponentsObject $components = null,
        public ?array $servers = null,
    ) {

    }
}
