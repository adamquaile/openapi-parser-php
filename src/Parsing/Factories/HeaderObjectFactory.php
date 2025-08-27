<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\HeaderObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class HeaderObjectFactory implements HeaderObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): HeaderObject
    {
        return new HeaderObject(
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
