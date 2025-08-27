<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
