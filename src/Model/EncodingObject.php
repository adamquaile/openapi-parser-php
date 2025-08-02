<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class EncodingObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?string $contentType = null,
        public ?HeaderObjectMap $headers = null,
        public ?string $style = null,
        public ?bool $explode = null,
        public ?bool $allowReserved = null,
        public object $x = new \stdClass(),
    ) {
    }
}
