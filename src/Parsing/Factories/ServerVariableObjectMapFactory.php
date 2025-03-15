<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MapTrait;
use TypeSlow\OpenApiParser\Model\ServerVariableObject;
use TypeSlow\OpenApiParser\Model\ServerVariableObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ServerVariableObjectMapFactory implements ServerVariableObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): ServerVariableObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $response) => $context->factory->create(ServerVariableObject::class, $response, $context)
        );

        return new ServerVariableObjectMap(items: $data);
    }
}
