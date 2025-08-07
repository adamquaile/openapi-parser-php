<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class ComponentsObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?SchemaObjectMap $schemas = null,
        public ?ResponseObjectMap $responses = null,
        public ?ParameterObjectMap $parameters = null,
        public ?ExampleObjectMap $examples = null,
        public ?RequestBodyObjectMap $requestBodies = null,
        public ?HeaderObjectMap $headers = null,
        public ?SecuritySchemeObjectMap $securitySchemes = null,
        public ?LinkObjectMap $links = null,
        public ?CallbackObjectMap $callbacks = null,
        public ?PathItemObjectMap $pathItems = null,
        public object $x = new \stdClass(),
    ) {
    }
}
