<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ResponseObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $description,
        public ?HeaderObjectMap $headers = null,
        public ?MediaTypeObjectMap $content = null,
        public ?LinkObjectMap $links = null,
        public object $x = new \stdClass(),
    ) {
    }
}
