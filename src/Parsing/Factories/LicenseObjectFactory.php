<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\LicenseObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class LicenseObjectFactory implements LicenseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): LicenseObject
    {
        $allowedData = [
            'name' => $data->name ?? null,
            'url' => $data->url ?? null,
        ];

        if ($context->version == Version::V3_1 && isset($data->identifier)) {
            $allowedData['identifier'] = $data->identifier;
            unset($allowedData['url']);
        }

        return new LicenseObject(
            name: $allowedData['name'],
            identifier: $allowedData['identifier'] ?? null,
            url: $allowedData['url'] ?? null,
        );
    }
}
