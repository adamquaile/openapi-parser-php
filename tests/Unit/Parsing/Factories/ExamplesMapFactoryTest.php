<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\ExamplesMap;
use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ExamplesMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ExamplesMap::class)]
#[CoversClass(ExamplesMapFactory::class)]
final class ExamplesMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use MapObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ExampleObject::class => new ExampleObject(value: $data->value),
                ReferenceObject::class => new ReferenceObject(ref: $data->{'$ref'}),
            });
    }

    public static function mapFactoryClass(): string
    {
        return ExamplesMapFactory::class;
    }

    public static function mapClass(): string
    {
        return ExamplesMap::class;
    }

    public static function examples(): iterable
    {
        yield 'example object example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'red' => (object) ['value' => 'red'],
                'blue' => (object) ['value' => 'blue'],
            ],
            'expected' => new ExamplesMap(items: (object) [
                'red' => new ExampleObject(value: 'red'),
                'blue' => new ExampleObject(value: 'blue'),
            ])
        ];
        yield 'reference object example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'reference' => (object) ['$ref' => '#/components/schemas/Example'],
            ],
            'expected' => new ExamplesMap(items: (object) [
                'reference' => new ReferenceObject(ref: '#/components/schemas/Example'),
            ])
        ];
    }

}
