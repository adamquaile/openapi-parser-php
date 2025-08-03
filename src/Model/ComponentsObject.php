<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ComponentsObject
{
    public function __construct(
        public ?SchemaObjectMap $schemas = null,
        public ?ResponseObjectMap $responses = null,
        public ?ParameterObjectMap $parameters = null,
        public ?ExampleObjectMap $examples = null,
        public ?RequestBodyObjectMap $requestBodies = null,
        public ?HeaderObjectMap $headers = null,
    ) {
    }
}
