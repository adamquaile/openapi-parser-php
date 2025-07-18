<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\CallbackObject;
use TypeSlow\OpenApiParser\Model\OperationObjectCallbacksMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OperationObjectCallbacksMapFactory implements OperationObjectCallbacksMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): OperationObjectCallbacksMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $header) => isset($header->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $header, $context)
                : $context->factory->create(CallbackObject::class, $header, $context)
        );
        return new OperationObjectCallbacksMap(items: $data);
    }
}
