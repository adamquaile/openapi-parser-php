<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\DiscriminatorObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
