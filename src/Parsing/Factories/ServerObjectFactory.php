<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\ServerVariableObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
