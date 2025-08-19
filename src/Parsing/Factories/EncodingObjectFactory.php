<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\EncodingObject;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
