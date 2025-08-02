<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\EncodingObject;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class EncodingObjectFactory implements EncodingObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): EncodingObject
    {
        return new EncodingObject(
            contentType: $data->contentType ?? null,
            headers: $context->factory->create(HeaderObjectMap::class, $data->headers ?? null, $context),
            style: $data->style ?? null,
            explode: $data->explode ?? null,
            allowReserved: $data->allowReserved ?? null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
