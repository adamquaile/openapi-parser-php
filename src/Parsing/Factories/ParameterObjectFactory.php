<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\ExamplesMap;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ParameterObjectFactory implements ParameterObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ParameterObject
    {
        return new ParameterObject(
            name: $data->name,
            in: $data->in,
            description: $data->description ?? null,
            required: $data->required ?? false,
            deprecated: $data->deprecated ?? false,
            allowEmptyValue: $data->allowEmptyValue ?? false,
            style: $data->style ?? null,
            explode: $data->explode ?? null,
            allowReserved: $data->allowReserved ?? false,
            schema: $context->factory->create(SchemaObject::class, $data->schema ?? null, $context),
            example: $data->example ?? null,
            examples: $context->factory->create(ExamplesMap::class, $data->examples ?? null, $context),
            content: $context->factory->create(MediaTypeObjectMap::class, $data->content ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
