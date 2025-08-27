<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\DiscriminatorObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class DiscriminatorObjectFactory implements DiscriminatorObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): DiscriminatorObject
    {
        return new DiscriminatorObject(
            $data->propertyName,
            $data->mapping ?? null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
