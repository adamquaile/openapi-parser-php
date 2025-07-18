<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OperationObjectParametersList;
use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OperationObjectParametersListFactory implements OperationObjectParametersListFactoryInterface
{
    use ListFactoryTrait;

    public function create(array $data, ParseContext $context): OperationObjectParametersList
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $parameter) => isset($parameter->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $parameter, $context)
                : $context->factory->create(ParameterObject::class, $parameter, $context)
        );
        return new OperationObjectParametersList(items: $data);
    }
}
