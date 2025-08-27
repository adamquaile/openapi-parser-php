<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\TagObject;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class TagObjectFactory implements TagObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): TagObject
    {
        return new TagObject(
            name: $data->name,
            description: $data->description ?? null,
            externalDocs: $context->factory->create(ExternalDocumentationObject::class, $data->externalDocs ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}