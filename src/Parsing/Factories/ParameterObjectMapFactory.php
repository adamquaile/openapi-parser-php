<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\ParameterObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class ParameterObjectMapFactory implements ParameterObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): ParameterObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $parameter) => isset($parameter->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $parameter, $context)
                : $context->factory->create(ParameterObject::class, $parameter, $context),
        );

        return new ParameterObjectMap(items: $data);
    }
}
