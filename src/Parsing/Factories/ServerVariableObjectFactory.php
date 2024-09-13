<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ServerVariableObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ServerVariableObjectFactory implements ServerVariableObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerVariableObject
    {
        return new ServerVariableObject(
            default: $data->default,
            description: $data->description ?? null,
            enum: $data->enum ?? null,
        );
    }
}
