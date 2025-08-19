<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\CallbackObject;
use AdamQ\OpenApiParser\Model\OperationObjectCallbacksMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
