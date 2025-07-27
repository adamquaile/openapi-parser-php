<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OperationObject;
use TypeSlow\OpenApiParser\Model\ParametersList;
use TypeSlow\OpenApiParser\Model\PathItemObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Model\ServersList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class PathItemObjectFactory implements PathItemObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): PathItemObject
    {
        return new PathItemObject(
            ref: $data->{'$ref'} ?? null,
            summary: $data->summary ?? null,
            description: $data->description ?? null,
            get: $context->factory->create(OperationObject::class, $data->get ?? null, $context),
            put: $context->factory->create(OperationObject::class, $data->put ?? null, $context),
            post: $context->factory->create(OperationObject::class, $data->post ?? null, $context),
            delete: $context->factory->create(OperationObject::class, $data->delete ?? null, $context),
            options: $context->factory->create(OperationObject::class, $data->options ?? null, $context),
            head: $context->factory->create(OperationObject::class, $data->head ?? null, $context),
            patch: $context->factory->create(OperationObject::class, $data->patch ?? null, $context),
            trace: $context->factory->create(OperationObject::class, $data->trace ?? null, $context),
            servers: $context->factory->create(ServersList::class, $data->servers ?? null, $context),
            parameters: $context->factory->create(ParametersList::class, $data->parameters ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
