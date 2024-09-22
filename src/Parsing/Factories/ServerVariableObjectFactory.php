<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ServerVariableObjectFactory implements ServerVariableObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ServerVariableObject
    {
        return new ServerVariableObject(
            default: $data->default,
            description: $data->description ?? null,
            enum: $data->enum ?? null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
