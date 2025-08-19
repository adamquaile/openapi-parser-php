<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ContactObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\LicenseObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
