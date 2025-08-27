<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\OAuthFlowObject;
use AdamQ\OpenApiParser\Model\OAuthFlowScopesMap;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\OAuthFlowObjectFactory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(OAuthFlowObjectFactory::class)]
#[CoversClass(OAuthFlowObject::class)]
#[CoversClass(OAuthFlowScopesMap::class)]
final class OAuthFlowObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'example from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'authorizationUrl' => 'https://example.com/api/oauth/dialog',
                'tokenUrl' => 'https://example.com/api/oauth/token',
                'scopes' => (object) [
                    'write:pets' => 'modify pets in your account',
                    'read:pets' => 'read your pets',
                ],
            ],
            'expected' => new OAuthFlowObject(
                authorizationUrl: 'https://example.com/api/oauth/dialog',
                tokenUrl: 'https://example.com/api/oauth/token',
                scopes: new OAuthFlowScopesMap(items: (object) [
                    'write:pets' => 'modify pets in your account',
                    'read:pets' => 'read your pets',
                ]),
            ),
        ];
    }
}
