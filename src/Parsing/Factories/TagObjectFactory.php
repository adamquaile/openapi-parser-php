<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\TagObject;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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