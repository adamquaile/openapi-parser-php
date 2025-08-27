<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class ParametersListFactory implements ParametersListFactoryInterface
{
    use ListFactoryTrait;

    public function create(array $data, ParseContext $context): ParametersList
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $parameter) => isset($parameter->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $parameter, $context)
                : $context->factory->create(ParameterObject::class, $parameter, $context)
        );
        return new ParametersList(items: $data);
    }
}
