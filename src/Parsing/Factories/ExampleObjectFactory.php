<?php

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ExampleObjectFactory implements ExampleObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ExampleObject
    {
        return new ExampleObject(
            summary: $data->summary ?? null,
            description: $data->description ?? null,
            value: $data->value,
            x: $this->parsedExtensionObject($data),
        );
    }
}
