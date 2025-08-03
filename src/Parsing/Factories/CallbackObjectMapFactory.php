<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\CallbackObject;
use TypeSlow\OpenApiParser\Model\CallbackObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
