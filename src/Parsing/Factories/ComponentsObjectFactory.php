<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ComponentsObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Model\SchemasObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ComponentsObjectFactory
{
    public function create(object $data, ParseContext $context): ComponentsObject
    {
        return new ComponentsObject(
            schemas: $context->factory->create(SchemasObject::class, $data->schemas ?? null, $context),
            responses: $context->factory->create(ResponsesObject::class, $data->responses ?? null, $context),
        );
    }
}
