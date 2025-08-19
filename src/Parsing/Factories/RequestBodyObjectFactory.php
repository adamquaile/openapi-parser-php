<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class RequestBodyObjectFactory implements RequestBodyObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): RequestBodyObject
    {
        return new RequestBodyObject(
            content: $context->factory->create(MediaTypeObjectMap::class, $data->content ?? null, $context),
            description: $data->description ?? null,
            required: $data->required ?? false,
            x: $this->parsedExtensionObject($data),
        );
    }
}
