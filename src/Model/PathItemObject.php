<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class PathItemObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?string $ref = null,
        public ?string $summary = null,
        public ?string $description = null,
        public ?OperationObject $get = null,
        public ?OperationObject $put = null,
        public ?OperationObject $post = null,
        public ?OperationObject $delete = null,
        public ?OperationObject $options = null,
        public ?OperationObject $head = null,
        public ?OperationObject $patch = null,
        public ?OperationObject $trace = null,
        public ?ServersList $servers = null,
        public ?ParametersList $parameters = null,
        public object $x = new \stdClass(),
    ) {
    }
}