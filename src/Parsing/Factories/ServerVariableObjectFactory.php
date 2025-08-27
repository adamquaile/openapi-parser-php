<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ServerVariableObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
