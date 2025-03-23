<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ExternalDocumentationObjectFactory implements ExternalDocumentationObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ExternalDocumentationObject
    {
        return new ExternalDocumentationObject(
            url: $data->url,
            description: $data->description ?? null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
