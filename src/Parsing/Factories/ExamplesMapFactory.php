<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class ExamplesMapFactory implements ExamplesMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): ExamplesMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $example) => match (true) {
                isset($example->{'$ref'}) => $context->factory->create(ReferenceObject::class, $example, $context),
                default => $context->factory->create(ExampleObject::class, $example, $context)
            }
        );

        return new ExamplesMap(items: $data);
    }
}
