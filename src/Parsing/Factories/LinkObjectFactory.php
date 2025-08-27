<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\LinkObject;
use AdamQ\OpenApiParser\Model\LinkObjectParametersMap;
use AdamQ\OpenApiParser\Model\RuntimeExpression;
use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class LinkObjectFactory implements LinkObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): LinkObject
    {
        return new LinkObject(
            operationRef: $data->operationRef ?? null,
            operationId: $data->operationId ?? null,
            parameters: $context->factory->create(LinkObjectParametersMap::class, $data->parameters ?? null, $context),
            requestBody: is_string($data->requestBody ?? null) && str_starts_with(haystack: $data->requestBody, needle: '$')
                ? new RuntimeExpression($data->requestBody)
                : $data->requestBody ?? null,
            description: $data->description ?? null,
            server: $context->factory->create(ServerObject::class, $data->server ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
