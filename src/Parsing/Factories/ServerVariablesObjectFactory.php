<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MapTrait;
use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Model\ServerVariablesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ServerVariablesObjectFactory implements ServerVariablesObjectFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): ServerVariablesObject
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $response) => $context->factory->create(ServerVariableObject::class, $response, $context)
        );

        return new ServerVariablesObject(items: $data);
    }
}
