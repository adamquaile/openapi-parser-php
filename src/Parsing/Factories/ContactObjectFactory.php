<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ContactObjectFactory implements ContactObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ContactObject
    {
        return new ContactObject(
            name: $data->name ?? null,
            url: $data->url ?? null,
            email: $data->email ?? null,
            x: $this->parsedExtensionObject($data)
        );
    }
}
