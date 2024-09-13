<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ContactObject;
use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\LicenseObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\ParseContext;

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
