<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Model\ExampleObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ExampleObjectMapFactory implements ExampleObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): ExampleObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $example) => isset($example->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $example, $context)
                : $context->factory->create(ExampleObject::class, $example, $context),
        );

        return new ExampleObjectMap(items: $data);
    }
}
