<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ContactObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ContactObjectFactory implements ContactObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): ContactObject
    {
        return new ContactObject(
            name: $data['name'] ?? null,
            url: $data['url'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}
