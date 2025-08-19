<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\CallbackObjectMap;
use AdamQ\OpenApiParser\Model\ComponentsObject;
use AdamQ\OpenApiParser\Model\ExampleObjectMap;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\LinkObjectMap;
use AdamQ\OpenApiParser\Model\ParameterObjectMap;
use AdamQ\OpenApiParser\Model\PathItemObjectMap;
use AdamQ\OpenApiParser\Model\RequestBodyObjectMap;
use AdamQ\OpenApiParser\Model\ResponseObjectMap;
use AdamQ\OpenApiParser\Model\SchemaObjectMap;
use AdamQ\OpenApiParser\Model\SecuritySchemeObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class ComponentsObjectFactory implements ComponentsObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ComponentsObject
    {
        return new ComponentsObject(
            schemas: $context->factory->create(SchemaObjectMap::class, $data->schemas ?? null, $context),
            responses: $context->factory->create(ResponseObjectMap::class, $data->responses ?? null, $context),
            parameters: $context->factory->create(ParameterObjectMap::class, $data->parameters ?? null, $context),
            examples: $context->factory->create(ExampleObjectMap::class, $data->examples ?? null, $context),
            requestBodies: $context->factory->create(RequestBodyObjectMap::class, $data->requestBodies ?? null, $context),
            headers: $context->factory->create(HeaderObjectMap::class, $data->headers ?? null, $context),
            securitySchemes: $context->factory->create(SecuritySchemeObjectMap::class, $data->securitySchemes ?? null, $context),
            links: $context->factory->create(LinkObjectMap::class, $data->links ?? null, $context),
            callbacks: $context->factory->create(CallbackObjectMap::class, $data->callbacks ?? null, $context),
            pathItems: $context->factory->create(PathItemObjectMap::class, $data->pathItems ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
