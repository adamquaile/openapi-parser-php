<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Model\SecurityRequirementsList;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\SecurityRequirementsListFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(SecurityRequirementsList::class)]
#[CoversClass(SecurityRequirementsListFactory::class)]
final class SecurityRequirementsListFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SecurityRequirementObject::class => new SecurityRequirementObject(items: $data),
            });
    }


    public static function examples()
    {
        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => [],
            'expected' => new SecurityRequirementsList(items: []),
        ];

        yield 'single example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) ['api_key' => []],
            ],
            'expected' => new SecurityRequirementsList(items: [
                new SecurityRequirementObject(items: (object) ['api_key' => []]),
            ]),
        ];

        yield 'multiple example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) ['api_key' => []],
                (object) ['oauth2' => ['read', 'write']],
            ],
            'expected' => new SecurityRequirementsList(items: [
                new SecurityRequirementObject(items: (object) ['api_key' => []]),
                new SecurityRequirementObject(items: (object) ['oauth2' => ['read', 'write']]),
            ]),
        ];
    }
}
