<?php

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
