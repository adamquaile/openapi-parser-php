<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Model\ServerVariableObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class ServerObjectFactory implements ServerObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ServerObject
    {
        return new ServerObject(
            url: $data->url,
            description: $data->description ?? null,
            variables: $context->factory->create(ServerVariableObjectMap::class, $data->variables ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
