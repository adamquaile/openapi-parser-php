<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Model\OperationObjectCallbacksMap;
use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Model\SecurityRequirementsList;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class OperationObjectFactory implements OperationObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): OperationObject
    {
        return new OperationObject(
            tags: $data->tags ?? null,
            summary: $data->summary ?? null,
            description: $data->description ?? null,
            externalDocs: $context->factory->create(ExternalDocumentationObject::class, $data->externalDocs ?? null, $context),
            operationId: $data->operationId ?? null,
            parameters: $context->factory->create(ParametersList::class, $data->parameters ?? null, $context),
            requestBody: $context->factory->create(RequestBodyObject::class, $data->requestBody ?? null, $context),
            responses: $context->factory->create(ResponsesObject::class, $data->responses ?? null, $context),
            callbacks: $context->factory->create(OperationObjectCallbacksMap::class, $data->callbacks ?? null, $context),
            deprecated: $data->deprecated ?? false,
            security: $context->factory->create(SecurityRequirementsList::class, $data->security ?? null, $context),
            servers: $context->factory->create(ServersList::class, $data->servers ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
