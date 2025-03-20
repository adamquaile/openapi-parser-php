<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class LinkObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?string $operationRef = null,
        public ?string $operationId = null,
        public ?LinkObjectParametersMap $parameters = null,
        public mixed $requestBody = null,
        public ?string $description = null,
        public ?ServerObject $server = null,
        public object $x = new \stdClass(),
    ) {
    }
}
