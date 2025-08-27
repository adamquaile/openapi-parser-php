<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\DiscriminatorObject;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\XmlObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
