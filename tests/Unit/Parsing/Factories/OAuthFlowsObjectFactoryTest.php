<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\OAuthFlowObject;
use AdamQ\OpenApiParser\Model\OAuthFlowScopesMap;
use AdamQ\OpenApiParser\Model\OAuthFlowsObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\OAuthFlowsObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(OAuthFlowsObject::class)]
#[CoversClass(OAuthFlowsObjectFactory::class)]
final class OAuthFlowsObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected static function exampleFlow(): OAuthFlowObject
    {
        return new OAuthFlowObject(
            authorizationUrl: 'https://example.com/api/oauth/dialog',
            tokenUrl: 'https://example.com/api/oauth/token',
            scopes: new OAuthFlowScopesMap(items: (object)['read']),
            refreshUrl: null,
        );
    }

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                OAuthFlowObject::class => self::exampleFlow(),
            });
    }


    public static function examples(): iterable
    {
        yield 'minimal example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new OAuthFlowsObject(),
        ];

        yield 'full example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'implicit' => (object) [],
                'password' => (object) [],
                'clientCredentials' => (object) [],
                'authorizationCode' => (object) [],
            ],
            'expected' => new OAuthFlowsObject(
                implicit: self::exampleFlow(),
                password: self::exampleFlow(),
                clientCredentials: self::exampleFlow(),
                authorizationCode: self::exampleFlow(),
            ),
        ];
    }
}
