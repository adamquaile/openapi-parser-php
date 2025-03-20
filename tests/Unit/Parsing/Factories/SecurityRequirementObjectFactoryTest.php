<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\SecurityRequirementObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(SecurityRequirementObject::class)]
#[CoversClass(SecurityRequirementObjectFactory::class)]
final class SecurityRequirementObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'api_key example from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'api_key' => [],
            ],
            'expected' => new SecurityRequirementObject(items: (object) ['api_key' => []]),
        ];

        yield 'oauth2 example from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'petstore_auth' => [
                    'write:pets',
                    'read:pets',
                ],
            ],
            'expected' => new SecurityRequirementObject(items: (object) [
                'petstore_auth' => ['write:pets', 'read:pets']]
            ),
        ];
    }
}
