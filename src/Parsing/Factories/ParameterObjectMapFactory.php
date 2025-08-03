<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\ParameterObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
