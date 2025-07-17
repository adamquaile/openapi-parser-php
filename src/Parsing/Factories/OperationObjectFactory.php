<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\OperationObject;
use TypeSlow\OpenApiParser\Model\OperationObjectParametersList;
use TypeSlow\OpenApiParser\Model\RequestBodyObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
            parameters: $context->factory->create(OperationObjectParametersList::class, $data->parameters ?? null, $context),
            requestBody: $context->factory->create(RequestBodyObject::class, $data->requestBody ?? null, $context),
            responses: $context->factory->create(ResponsesObject::class, $data->responses ?? null, $context),
            deprecated: $data->deprecated ?? false,
            security: $context->factory->create(SecurityRequirementObject::class, $data->security ?? null, $context),
            servers: null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
