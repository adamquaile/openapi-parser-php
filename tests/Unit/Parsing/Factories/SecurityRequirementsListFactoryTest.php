<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\SecurityRequirementObject;
use AdamQ\OpenApiParser\Model\SecurityRequirementsList;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\SecurityRequirementsListFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

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
