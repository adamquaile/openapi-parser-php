<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ContactObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
