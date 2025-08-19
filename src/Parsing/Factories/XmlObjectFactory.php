<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\XmlObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class XmlObjectFactory implements XmlObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): XmlObject
    {
        return new XmlObject(
            $data->name,
            $data->namespace ?? null,
            $data->prefix ?? null,
            $data->attribute ?? false,
            $data->wrapped ?? false,
            x: $this->parsedExtensionObject($data),
        );
    }
}