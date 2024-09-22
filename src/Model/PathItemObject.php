<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class PathItemObject
{
    public function __construct(
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
        public ?ServerObject $servers = null,
        public ?ParameterObject $parameters = null,
    ) {
    }
}