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
    public function create(array $data, ParseContext $context): InfoObject
    {
        if ($context->version == Version::V3_0) {
            unset($data['summary']);
        }

        return new InfoObject(
            title: $data['title'],
            version: $data['version'],
            summary: $data['summary'] ?? null,
            description: $data['description'] ?? null,
            termsOfService: $data['termsOfService'] ?? null,
            contact: array_key_exists('contact', $data)
                ? $context->factory->create(ContactObject::class, $data['contact'], $context)
                : null,
            license: array_key_exists('license', $data)
                ? $context->factory->create(LicenseObject::class, $data['license'], $context)
                : null,
        );
    }
}
