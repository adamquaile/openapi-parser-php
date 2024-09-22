<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\LicenseObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
