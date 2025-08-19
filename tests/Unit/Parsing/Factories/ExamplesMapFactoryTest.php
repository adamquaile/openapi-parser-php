<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ExampleObject;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ExamplesMapFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\MapObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

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
