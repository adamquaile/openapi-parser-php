<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\CallbackObjectMap;
use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\ExampleObjectMap;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\ParameterObjectMap;
use TypeSlow\OpenApiParser\Model\PathItemObjectMap;
use TypeSlow\OpenApiParser\Model\RequestBodyObjectMap;
use TypeSlow\OpenApiParser\Model\ResponseObjectMap;
use TypeSlow\OpenApiParser\Model\SchemaObjectMap;
use TypeSlow\OpenApiParser\Model\SecuritySchemeObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
