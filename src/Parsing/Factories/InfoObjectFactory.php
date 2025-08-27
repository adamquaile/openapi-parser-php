<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ContactObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\LicenseObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class InfoObjectFactory implements InfoObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): InfoObject
    {
        if ($context->version == Version::V3_0) {
            unset($data->summary);
        }

        return new InfoObject(
            title: $data->title,
            version: $data->version,
            summary: $data->summary ?? null,
            description: $data->description ?? null,
            termsOfService: $data->termsOfService ?? null,
            contact: $context->factory->create(ContactObject::class, $data->contact ?? null, $context),
            license: $context->factory->create(LicenseObject::class, $data->license ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
