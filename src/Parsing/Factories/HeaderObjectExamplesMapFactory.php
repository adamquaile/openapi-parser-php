<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Model\HeaderObjectExamplesMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class HeaderObjectExamplesMapFactory implements HeaderObjectExamplesMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): HeaderObjectExamplesMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $example) => match (true) {
                isset($example->{'$ref'}) => $context->factory->create(ReferenceObject::class, $example, $context),
                default => $context->factory->create(ExampleObject::class, $example, $context)
            }
        );

        return new HeaderObjectExamplesMap(items: $data);
    }
}
