<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\CallbackObjectMap;
use AdamQ\OpenApiParser\Model\ComponentsObject;
use AdamQ\OpenApiParser\Model\ExampleObjectMap;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\LinkObjectMap;
use AdamQ\OpenApiParser\Model\ParameterObjectMap;
use AdamQ\OpenApiParser\Model\PathItemObjectMap;
use AdamQ\OpenApiParser\Model\RequestBodyObjectMap;
use AdamQ\OpenApiParser\Model\ResponseObjectMap;
use AdamQ\OpenApiParser\Model\SchemaObjectMap;
use AdamQ\OpenApiParser\Model\SecuritySchemeObjectMap;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ComponentsObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ComponentsObject::class)]
#[CoversClass(ComponentsObjectFactory::class)]
final class ComponentsObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SchemaObjectMap::class => new SchemaObjectMap(items: (object)[]),
                ResponseObjectMap::class => new ResponseObjectMap(items: (object)[]),
                ParameterObjectMap::class => new ParameterObjectMap(items: (object)[]),
                ExampleObjectMap::class => new ExampleObjectMap(items: (object)[]),
                RequestBodyObjectMap::class => new RequestBodyObjectMap(items: (object)[]),
                HeaderObjectMap::class => new HeaderObjectMap(items: (object)[]),
                SecuritySchemeObjectMap::class => new SecuritySchemeObjectMap(items: (object)[]),
                LinkObjectMap::class => new LinkObjectMap(items: (object)[]),
                CallbackObjectMap::class => new CallbackObjectMap(items: (object)[]),
                PathItemObjectMap::class => new PathItemObjectMap(items: (object)[]),
            });
    }

    public static function examples(): iterable
    {
        yield 'minimal example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new ComponentsObject(),
        ];

        yield 'full example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'schemas' => (object) [],
                'responses' => (object) [],
                'parameters' => (object) [],
                'examples' => (object) [],
                'requestBodies' => (object) [],
                'headers' => (object) [],
                'securitySchemes' => (object) [],
                'links' => (object) [],
                'callbacks' => (object) [],
                'pathItems' => (object) [],
            ],
            'expected' => new ComponentsObject(
                schemas: new SchemaObjectMap(items: (object)[]),
                responses: new ResponseObjectMap(items: (object)[]),
                parameters: new ParameterObjectMap(items: (object)[]),
                examples: new ExampleObjectMap(items: (object)[]),
                requestBodies: new RequestBodyObjectMap(items: (object)[]),
                headers: new HeaderObjectMap(items: (object)[]),
                securitySchemes: new SecuritySchemeObjectMap(items: (object)[]),
                links: new LinkObjectMap(items: (object)[]),
                callbacks: new CallbackObjectMap(items: (object)[]),
                pathItems: new PathItemObjectMap(items: (object)[]),
            ),
        ];
    }
}