<?php

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\TagObject;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\TagObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(TagObject::class)]
#[CoversClass(TagObjectFactory::class)]
class TagObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ExternalDocumentationObject::class => new ExternalDocumentationObject(
                    url: 'https://example.com',
                    description: 'Find more info here',
                ),
            });
    }

    public static function examples(): iterable
    {
        yield 'minimal example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'pet',
            ],
            'expected' => new TagObject(
                name: 'pet'
            ),
        ];

        yield 'full example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'pet',
                'description' => 'Pets operations',
                'externalDocs' => (object) [
                    'description' => 'Find more info here',
                    'url' => 'https://example.com',
                ],
            ],
            'expected' => new TagObject(
                name: 'pet',
                description: 'Pets operations',
                externalDocs: new ExternalDocumentationObject(
                    url: 'https://example.com',
                    description: 'Find more info here',
                )
            ),
        ];
    }
}
