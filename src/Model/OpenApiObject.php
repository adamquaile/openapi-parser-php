<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final readonly class OpenApiObject
{
    public function __construct(
        public string $openapi,
        public InfoObject $info,
        public ?PathsObject $paths = null,
        public ?ComponentsObject $components = null,
    ) {

    }
}
