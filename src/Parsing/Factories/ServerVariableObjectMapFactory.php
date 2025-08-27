<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\MapTrait;
use AdamQ\OpenApiParser\Model\ServerVariableObject;
use AdamQ\OpenApiParser\Model\ServerVariableObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
