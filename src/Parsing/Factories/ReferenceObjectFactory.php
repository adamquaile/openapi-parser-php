<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\LicenseObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ReferenceObjectFactory implements ReferenceObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ReferenceObject
    {
        if ($context->version == Version::V3_0) {
            return new ReferenceObject(
                ref: $data->{'$ref'},
            );
        }

        return new ReferenceObject(
            ref: $data->{'$ref'},
            name: $data->name ?? null,
            description: $data->description ?? null,
        );
    }
}
