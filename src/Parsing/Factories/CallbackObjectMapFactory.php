<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\CallbackObject;
use AdamQ\OpenApiParser\Model\CallbackObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class CallbackObjectMapFactory implements CallbackObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): CallbackObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $callback) => isset($callback->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $callback, $context)
                : $context->factory->create(CallbackObject::class, $callback, $context)
        );
        return new CallbackObjectMap(items: $data);
    }
}
