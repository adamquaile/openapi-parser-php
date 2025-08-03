<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\ResponseObjectMap;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Model\SchemaObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ComponentsObjectFactory
{
    public function create(object $data, ParseContext $context): ComponentsObject
    {
        return new ComponentsObject(
            schemas: $context->factory->create(SchemaObjectMap::class, $data->schemas ?? null, $context),
            responses: $context->factory->create(ResponseObjectMap::class, $data->responses ?? null, $context),
        );
    }
}
