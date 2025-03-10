<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\DiscriminatorObject;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\XmlObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class SchemaObjectFactory implements SchemaObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): SchemaObject
    {
        return new SchemaObject(
            dynamic: $this->removeExtendedKeys($data),
            discriminator: $context->factory->create(DiscriminatorObject::class, $data->discriminator ?? null, $context),
            xml: $context->factory->create(XmlObject::class, $data->xml ?? null, $context),
            externalDocs: $context->factory->create(ExternalDocumentationObject::class, $data->externalDocs ?? null, $context),
            x: $this->parsedExtensionObject($data)
        );
    }
}
