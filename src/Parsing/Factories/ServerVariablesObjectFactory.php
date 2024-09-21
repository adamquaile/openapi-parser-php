<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MapTrait;
use Worq\OpenApiParser\Model\ServerVariableObject;
use Worq\OpenApiParser\Model\ServerVariablesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

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
