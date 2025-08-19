<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Model\ExampleObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
